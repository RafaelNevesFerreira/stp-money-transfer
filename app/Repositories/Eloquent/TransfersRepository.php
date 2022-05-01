<?php

namespace App\Repositories\Eloquent;

use DateTime;
use App\Models\Transfer;
use App\Pipes\DateFilter;
use App\Pipes\StatusFilter;
use App\Jobs\PaimentSuccess;
use Illuminate\Support\Carbon;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Contracts\TransfersRepositoryInterface;

class TransfersRepository extends AbstractRepository implements TransfersRepositoryInterface
{

    public $DOLAR_EURO_PARA = 0.953370;
    public $LIBRA_EURO_PARA = 1.16866;

    public $model;
    public function __construct()
    {
        $this->model = new Transfer();
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
        if (session("plan")) {
            $plan = session("plan");
        } else {
            $plan = false;
        }

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
            "plan" => $plan,
            "email" => $email,
            "tax" => session("tax"),
            "value_sended" => session("valor_a_ser_enviado"),
            "destinatary_name" => session("receptor"),
            "transfer_code" => $transfer_code,
        ]);

        PaimentSuccess::dispatch($email, session("name"), $transfer_code, session("receptor"))->delay(now());
    }

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

    public function details($id)
    {

        return $this->model::where("id", $id)->firstOrFail();
    }

    public function received_this_month()
    {
        return $this->model::where("status", "received")->whereMonth('created_at', date("m"))->count();
    }

    public function reimbursed_this_month()
    {
        return $this->model::where("status", "reimbursed")->whereMonth('created_at', date("m"))->count();
    }

    public function abonement_this_month()
    {
        return $this->model::where("plan", 1)->whereMonth('created_at', date("m"))->count();
    }

    public function to_received_this_month()
    {
        return $this->model::where("status", "sended")->whereMonth('created_at', date("m"))->count();
    }

    public function transfers_today()
    {
        return $this->model::whereDay('created_at', date("d"))->limit(4)->get();
    }

    public function change_status($id, $reembolsado = false)
    {
        if ($reembolsado) {
            $this->model::where("id", $id)->update([
                "status" => "reimbursed",
            ]);
        } else {
            $this->model::where("id", $id)->update([
                "status" => "received",
                "received_at" => now()
            ]);
        }
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

    public function numero_de_prestações_da_semana()
    {
        return $this->model::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where("plan", 1)->count();
    }

    public function saldo_semanal()
    {
        $pagos_em_prestacoes_com_euro = $this->model::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->where(["plan" => 1])
            ->sum(DB::raw("(((value_sended + tax) * 20) / 100 + (value_sended + tax)) / 2"));


        $pagos_com_euro = $this->model::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->where(["plan" => 0])
            ->sum(DB::raw("value_sended + tax"));


        return $pagos_com_euro + $pagos_em_prestacoes_com_euro;
    }

    public function saldo_semana_passada($total = false, $start_week = null, $end_week = null)
    {
        $previous_week = strtotime("-1 week +1 day");
        $start_week = strtotime("last Monday midnight", $previous_week);
        $end_week = strtotime("next sunday", $start_week);
        $start_week = date("Y-m-d", $start_week);
        $end_week = date("Y-m-d", $end_week);


        $pagos_em_prestacoes_com_euro = $this->model::whereBetween('created_at', [$start_week, $end_week])
            ->where(["plan" => 1])
            ->sum(DB::raw("(((value_sended + tax) * 20) / 100 + (value_sended + tax)) / 2"));

        $pagos_com_euro = $this->model::whereBetween('created_at', [$start_week, $end_week])
            ->where(["plan" => 0])
            ->sum(DB::raw("value_sended + tax"));

        if ($total == true) {
            return $pagos_em_prestacoes_com_euro + $pagos_com_euro;
        }
        $semana_passada = $pagos_em_prestacoes_com_euro + $pagos_com_euro;
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

        $pagos_em_prestacoes_com_euro = $this->model::whereMonth('created_at', $mes)
            ->whereYear("created_at", date("Y"))
            ->where(["plan" => 1])
            ->sum(DB::raw("(((value_sended + tax) * 20) / 100 + (value_sended + tax)) / 2"));

        $pagos_com_euro = $this->model::whereMonth('created_at', $mes)
            ->whereYear("created_at", date("Y"))
            ->where(["plan" => 0])
            ->sum(DB::raw("value_sended + tax"));

        return $pagos_em_prestacoes_com_euro + $pagos_com_euro;
    }

    public function mes_ano_passado($mes)
    {
        $pagos_em_prestacoes_com_euro = $this->model::whereMonth('created_at', '=', $mes)
            ->whereYear('created_at', date('Y', strtotime('-1 year')))
            ->where(["plan" => 1])
            ->sum(DB::raw("(((value_sended + tax) * 20) / 100 + (value_sended + tax)) / 2"));

        $pagos_com_euro = $this->model::whereMonth('created_at', '=', $mes)
            ->whereYear('created_at', date('Y', strtotime('-1 year')))
            ->where(["plan" => 0])
            ->sum(DB::raw("value_sended + tax"));

        return $pagos_em_prestacoes_com_euro + $pagos_com_euro;
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

    public function pagos_em_prestacoes_ou_cash($plan, $month, $year)
    {


        if ($plan === 1) {
            return $this->model::whereMonth('created_at', $month)
                ->whereYear("created_at", $year)
                ->where(["plan" => 1])
                ->sum(DB::raw("(((value_sended + tax) * 20) / 100 + (value_sended + tax)) / 2"));
        } else {
            return $this->model::whereMonth('created_at', $month)
                ->whereYear("created_at", $year)
                ->where(["plan" => 0])
                ->sum(DB::raw("value_sended + tax"));
        }
    }

    public function transferencias_recentes($month, $year, $limit)
    {
        return $this->model::whereMonth("created_at", $month)->whereYear("created_at", $year)->latest()->limit($limit)->get();
    }

    public function saldo_semanal_em_dias($date)
    {
        $pegos = $this->model::where("created_at", ">", Carbon::now()->endOfWeek()->subdays($date))
            ->where("created_at", "<=", Carbon::now()->endOfWeek()->subdays($date - 1))
            ->where(["plan" => 0])
            ->sum(DB::raw("value_sended + tax"));


        $prestacoes = $this->model::where("created_at", ">", Carbon::now()->endOfWeek()->subdays($date))
            ->where("created_at", "<=", Carbon::now()->endOfWeek()->subdays($date - 1))
            ->where(["plan" => 1])
            ->sum(DB::raw("(((value_sended + tax) * 20) / 100 + (value_sended + tax)) / 2"));



        return number_format($pegos + $prestacoes, 2, ".", ".");
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
            ->where(["plan" => 0])
            ->sum(DB::raw("value_sended + tax"));

        $prestacoes = $this->model::where("created_at", ">", $start_week)
            ->where("created_at", "<", $end_week)
            ->where(["plan" => 1])
            ->sum(DB::raw("(((value_sended + tax) * 20) / 100 + (value_sended + tax)) / 2"));


        return number_format($pagos + $prestacoes, 2, ".", ".");
    }

    public function paises()
    {
        return $this->model::distinct("country")->get("country");
    }

    public function money_by_country($country)
    {
        $pagos = $this->model::whereMonth('created_at', date("m"))
            ->whereYear("created_at", date("Y"))
            ->where(["plan" => 0, "country" => $country])
            ->sum(DB::raw("value_sended + tax"));

        $prestacoes = $this->model::whereMonth('created_at', date("m"))
            ->whereYear("created_at", date("Y"))
            ->where(["plan" => 1, "country" => $country])
            ->sum(DB::raw("(((value_sended + tax) * 20) / 100 + (value_sended + tax)) / 2"));

        return number_format($pagos + $prestacoes, 2, ".", ".");
    }

    public function top_5_transacoes($month, $year, $limit, $min, $max)
    {
        return $this->model::whereMonth("created_at", $month)
            ->whereYear("created_at", $year)
            ->where("plan", 0)
            ->where("value_sended", ">", $min)
            ->where("value_sended", "<", $max)
            ->limit($limit)
            ->get();
    }

    public function user_count_transactions($email, $prestacoes = 3)
    {
        if ($prestacoes == 1) {
            return $this->model::where("plan", 1)
                ->where("email", $email)
                ->count();
        } elseif ($prestacoes == 0) {
            return $this->model::where("email", $email)
                ->where("plan", 0)
                ->count();
        } else {
            return $this->model::where("email", $email)->count();
        }
    }

    public function user_transaction_by_month($email, $month, $year)
    {
        $pagos_em_prestacoes_com_euro = $this->model::whereMonth('created_at', $month)
            ->whereYear("created_at", $year)
            ->where(["plan" => 1, "email" => $email])
            ->sum(DB::raw("(((value_sended + tax) * 20) / 100 + (value_sended + tax)) / 2"));

        $pagos_com_euro = $this->model::whereMonth('created_at', $month)
            ->whereYear("created_at", $year)
            ->where(["plan" => 0, "email" => $email])
            ->sum(DB::raw("value_sended + tax"));

        return $pagos_em_prestacoes_com_euro + $pagos_com_euro;
    }

    public function transaction_by_user($email)
    {
        return $this->model::where("email", $email)->get();
    }
}
