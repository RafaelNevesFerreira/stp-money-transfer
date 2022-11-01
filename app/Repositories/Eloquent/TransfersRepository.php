<?php

namespace App\Repositories\Eloquent;

use App\Http\Controllers\SendMoneyController;
use DateTime;
use App\Models\Transfer;
use App\Pipes\DateFilter;
use App\Pipes\StatusFilter;
use App\Jobs\PaimentSuccess;
use App\Models\TransferComprovative;
use App\Models\TransferReception;
use App\Repositories\Contracts\NotificationsRepositoryInterface;
use Illuminate\Support\Carbon;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Contracts\TransfersRepositoryInterface;
use phpDocumentor\Reflection\Types\Null_;

class TransfersRepository extends AbstractRepository implements TransfersRepositoryInterface
{

    public function __construct(
        public Transfer $model,
        public NotificationsRepositoryInterface $notifications,
        public TransferReception $transfer_receptor,
        public SendMoneyController $send_money_controller
    ) {
    }

    public function store()
    {
        switch (session("moeda")) {
            case "€":
                $currency = "eur";
                break;
            case '$':
                $currency = "usd";
                break;
            case '£':
                $currency = "gbp";

                break;
        }
        $transfer_code = uniqid("SMT");

        if (Auth::check()) {
            $email = Auth::user()->email;
        } else {
            $email = session("email");
        }
        $this->model::create([
            "name" => session("name"),
            "address" => session("address"),
            "currency" => $currency,
            "country" => session("country"),
            "phone_number" => session("phone_number"),
            "email" => $email,
            "tax" => session("tax"),
            "value_sended" => session("valor_a_ser_enviado"),
            "destinatary_name" => session("receptor"),
            "transfer_code" => $transfer_code,
        ]);

        PaimentSuccess::dispatch($email, session("name"), $transfer_code, session("receptor"))->delay(now());
    }

    //criar uma nova transação apartir do painel tecnico ou admin
    public function new_transfer($request)
    {
        //crio o ID unico que sera transmitido ao usuario para poder levantar o dinheiro
        $transfer_code = uniqid("SMT");

        //tiro a caracte "." do valor enviado
        $valor = (float) str_replace(".", "", $request["valor_enviado"]);

        //calculo a taxa com base no valor
        $tax = $this->send_money_controller->calculate_tax($valor);

        //crio a transfer
        return $this->model::create([
            "name" => $request["name"],
            "address" => $request["address"],
            "currency" => $request["moeda"],
            "country" => $request["country"],
            "phone_number" => $request["phone_number"],
            "email" => $request["email"],
            "tax" => $tax,
            "payment_method" => $request["payment_method"],
            "value_sended" => $valor,
            "destinatary_name" => $request["destinatary_name"],
            "transfer_code" => $transfer_code,
        ]);

        //dispacho a job responsavel por enviar o email de confirmação ao usuario
        PaimentSuccess::dispatch($request["email"], $request["name"], $transfer_code, $request["destinatary_name"])->delay(now());
    }

    //função para tratar do upload dos comprovativos enviados pelo painel do tecnico ou do admin
    public function storeImage($request, $id)
    {
        //cria uma instância do model e atribuo a uma variavel
        $data = new TransferComprovative();

        //verifico se na request existe algum parametro denominado file
        if ($request->file('comprovativo')) {
            //atribuo o parametro vindo da request a variavel filek
            $file = $request->file('comprovativo');
            //crio o nome que sera atribuido ao ficheiro
            $filename = date('YmdHi') . $file->getClientOriginalName();
            //mouvo o ficheiro para a pasta designada a baixo
            $file->move(public_path('images/comprovative'), $filename);

            //crio um novo transfer comprovative
            $data['name'] = $filename;
            $data['transfer_id'] = $id;
            $data['user_id'] = Auth::user()->id;
        }
        //salvo
        $data->save();
    }

    //função responsavel pelos filtros feitos no frontofficed pelo usuario na pagina de transfers
    public function get_by_user_email()
    {

        return app(Pipeline::class)
            ->send($this->model::where("email", Auth::user()->email))
            ->through([
                StatusFilter::class,
                DateFilter::class,
            ])
            ->thenReturn()
            ->latest()
            ->paginate(6);
    }

    //metodo responsavel por retornar uma transfer pelo seu id
    public function details($id)
    {
        return $this->model::where("id", $id)->firstOrFail();
    }

    //metodo responsavel por retornar o numero de transacoes realizadas esse mês
    public function received()
    {
        return $this->model::where("status", "received")->whereMonth('created_at', date("m"))->count();
    }

    public function reimbursed_this_month()
    {
        return $this->model::where("status", "reimbursed")->whereMonth('created_at', date("m"))->count();
    }

    public function to_receive()
    {
        return $this->model::where("status", "sended")->count();
    }

    public function transfers_today()
    {
        return $this->model::whereDay('created_at', date("d"))->limit(4)->get();
    }

    public function change_status($id, $request)
    {
        $transfer = $this->model::where("id", $id)->firstOrFail();

        $transfer->status = "received";
        $transfer->received_at = now();
        $transfer->save();

        $this->transfer_receptor->create([
            "name" => $request["name"],
            "last_name" => $request["last_name"],
            "nationality" => $request["nationality"],
            "birthday_date" => $request["birthday_date"],
            "transfer_id" => $transfer->id,
        ]);


        $this->notifications->save($transfer);
    }

    public function transfers_esta_semana(): int
    {
        return $this->model::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
    }

    public function aumento_em_relacao_a_semana_passada(): float
    {
        $previous_week = strtotime("-1 week +1 day");
        $start_week = strtotime("last Monday midnight", $previous_week);
        $end_week = strtotime("next sunday", $start_week);
        $start_week = date("Y-m-d", $start_week);
        $end_week = date("Y-m-d", $end_week);


        $semana_passada =  $this->model::whereBetween('created_at', [$start_week, $end_week])->count();
        $valor_inicial = $semana_passada;
        $valor_final = $this->transfers_esta_semana();

        if ($valor_inicial > 0) {
            $diferença = ($valor_final - $valor_inicial) / $valor_inicial * 100;
        } else {
            $diferença = 0;
        }
        return $diferença;
    }

    public function saldo_semanal()
    {
        return $this->model::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->sum(DB::raw("value_sended + tax"));
    }

    public function saldo_semana_passada($total = false, $start_week = null, $end_week = null)
    {
        $previous_week = strtotime("-1 week +1 day");
        $start_week = strtotime("last Monday midnight", $previous_week);
        $end_week = strtotime("next sunday", $start_week);
        $start_week = date("Y-m-d", $start_week);
        $end_week = date("Y-m-d", $end_week);

        $recebido = $this->model::whereBetween('created_at', [$start_week, $end_week])
            ->sum(DB::raw("value_sended + tax"));

        if ($total == true) {
            return $recebido;
        }
        $semana_passada = $recebido;
        $esta_semana = $this->saldo_semanal();


        if ($semana_passada > 0) {
            $diferença = ($esta_semana - $semana_passada) / $semana_passada * 100;
        } else {
            $diferença = 0;
        }
        return $diferença;
    }

    public function mes($mes)
    {
        return $this->model::whereMonth('created_at', $mes)
            ->whereYear("created_at", date("Y"))
            ->sum(DB::raw("value_sended + tax"));
    }

    public function mes_ano_passado($mes)
    {
        return  $this->model::whereMonth('created_at', '=', $mes)
            ->whereYear('created_at', date('Y', strtotime('-1 year')))
            ->sum(DB::raw("value_sended + tax"));
    }

    public function dados_grafico_receita()
    {
        $meses = [];
        for ($i = 1; $i < 13; $i++) {
            $mes = $this->mes($i);
            array_push($meses, $mes);
        }

        return $meses;
    }

    public function dados_grafico_receita_ano_passado()
    {
        $meses = [];
        for ($i = 1; $i < 13; $i++) {
            $mes = $this->mes_ano_passado($i);
            array_push($meses, $mes);
        }

        return $meses;
    }

    public function pago_mes_ano($month, $year, $payment_method)
    {
        return $this->model::whereMonth('created_at', $month)
            ->whereYear("created_at", $year)
            ->where("payment_method", $payment_method)
            ->sum(DB::raw("value_sended + tax"));
    }

    public function transferencias_recentes($month, $year, $limit)
    {
        return $this->model::whereMonth("created_at", $month)->whereYear("created_at", $year)->latest()->limit($limit)->get();
    }

    public function saldo_semanal_em_dias($date)
    {
        return $this->model::where("created_at", ">", Carbon::now()->endOfWeek()->subdays($date))
            ->where("created_at", "<=", Carbon::now()->endOfWeek()->subdays($date - 1))
            ->sum(DB::raw("value_sended + tax"));
    }

    public function saldo_semana_passada_em_dias($date)
    {
        $previous_week = strtotime("-1 week +1 day");
        $start_week = strtotime("last Monday midnight", $previous_week);
        $end_week = strtotime("next sunday", $start_week);
        $start_week = date("Y-m-d", $start_week);
        $end_week = date("Y-m-d", $end_week);
        $start_week = new DateTime($start_week);
        $end_week = new DateTime($end_week);


        $i = $date - 1;
        $i2 = 6 - $date;
        $start_week->modify("+$i day");
        $end_week->modify("-$i2 days");

        $pagos = $this->model::where("created_at", ">", $start_week)
            ->where("created_at", "<", $end_week)
            ->sum(DB::raw("value_sended + tax"));


        return number_format($pagos, 0, "", "");
    }

    public function paises()
    {
        return $this->model::distinct("country")->get("country");
    }

    public function money_by_country($country)
    {
        $pagos = $this->model::whereMonth('created_at', date("m"))
            ->whereYear("created_at", date("Y"))
            ->where("country", $country)
            ->sum(DB::raw("value_sended + tax"));

        return number_format($pagos, 2, ",", ".");
    }

    public function top_5_transacoes($month, $year, $limit, $min, $max)
    {
        return $this->model::whereMonth("created_at", $month)
            ->whereYear("created_at", $year)
            ->where("value_sended", ">", $min)
            ->where("value_sended", "<", $max)
            ->limit($limit)
            ->get();
    }

    public function user_count_transactions($email, $payment_method = null)
    {
        if ($payment_method) {
            return $this->model::where(["email" => $email, "payment_method" => $payment_method])->count();
        }
        return $this->model::where("email", $email)->count();
    }

    public function user_total_payment($email, $payment_method = null)
    {
        if ($payment_method) {
            return $this->model::where(["email" => $email, "payment_method" => $payment_method])->sum(DB::raw("value_sended+tax"));
        }
        return $this->model::where("email", $email)->count();
    }

    public function user_transaction_by_month($email, $month, $year)
    {
        $pagos_com_euro = $this->model::whereMonth('created_at', $month)
            ->whereYear("created_at", $year)
            ->where(["email" => $email])
            ->sum(DB::raw("value_sended + tax"));

        return  $pagos_com_euro;
    }

    public function transaction_by_user($email)
    {
        return $this->model::where("email", $email)->get();
    }
}
