<?php

namespace App\Repositories\Eloquent;

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

    public function change_status($id)
    {
        $this->model::where("id", $id)->update([
            "status" => "received",
            "received_at" => now()
        ]);
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
        $pagos_em_prestacoes_com_libra = $this->model::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->where(["plan" => 1, "currency" => "gbp"])
            ->sum(DB::raw("(((value_sended + tax) * 20) / 100 + (value_sended + tax)) / 2"));

        $pagos_em_prestacoes_com_dolar = $this->model::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->where(["plan" => 1, "currency" => "usd"])
            ->sum(DB::raw("(((value_sended + tax) * 20) / 100 + (value_sended + tax)) / 2"));

        $dolar_para_euro_prestacoes = $pagos_em_prestacoes_com_dolar * $this->DOLAR_EURO_PARA / 1;
        $libra_para_euro_prestacoes = $pagos_em_prestacoes_com_libra * $this->LIBRA_EURO_PARA / 1;

        $pagos_em_prestacoes_com_euro = $this->model::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->where(["plan" => 1, "currency" => "eur"])
            ->sum(DB::raw("(((value_sended + tax) * 20) / 100 + (value_sended + tax)) / 2"));

        //1 EUR = 1,05083 USD

        $pagos_com_libra = $this->model::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->where(["plan" => 0, "currency" => "gbp"])
            ->sum(DB::raw("value_sended + tax"));

        $pagos_com_dolar = $this->model::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->where(["plan" => 0, "currency" => "usd"])
            ->sum(DB::raw("value_sended + tax"));

        $pagos_com_euro = $this->model::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->where(["plan" => 0, "currency" => "eur"])
            ->sum(DB::raw("value_sended + tax"));

        $dolar_para_euro = $pagos_com_dolar * $this->DOLAR_EURO_PARA / 1;
        $libra_para_euro = $pagos_com_libra *  $this->LIBRA_EURO_PARA / 1;

        $sem_prestacoes = $pagos_com_euro + $dolar_para_euro + $libra_para_euro;
        $com_prestacoes = $pagos_em_prestacoes_com_euro + $dolar_para_euro_prestacoes + $libra_para_euro_prestacoes;

        // dd($pagos_em_prestacoes_com_euro);
        return $sem_prestacoes + $com_prestacoes;
    }

    public function saldo_semana_passada($start_week = null, $end_week = null)
    {
        $previous_week = strtotime("-1 week +1 day");
        $start_week = strtotime("last Monday midnight", $previous_week);
        $end_week = strtotime("next sunday", $start_week);
        $start_week = date("Y-m-d", $start_week);
        $end_week = date("Y-m-d", $end_week);

        $pagos_em_prestacoes_com_libra = $this->model::whereBetween('created_at', [$start_week, $end_week])
            ->where(["plan" => 1, "currency" => "gbp"])
            ->sum(DB::raw("(((value_sended + tax) * 20) / 100 + (value_sended + tax)) / 2"));

        $pagos_em_prestacoes_com_dolar = $this->model::whereBetween('created_at', [$start_week, $end_week])
            ->where(["plan" => 1, "currency" => "usd"])
            ->sum(DB::raw("(((value_sended + tax) * 20) / 100 + (value_sended + tax)) / 2"));

        $dolar_para_euro_prestacoes = $pagos_em_prestacoes_com_dolar * $this->DOLAR_EURO_PARA / 1;
        $libra_para_euro_prestacoes = $pagos_em_prestacoes_com_libra * $this->LIBRA_EURO_PARA / 1;

        $pagos_em_prestacoes_com_euro = $this->model::whereBetween('created_at', [$start_week, $end_week])
            ->where(["plan" => 1, "currency" => "eur"])
            ->sum(DB::raw("(((value_sended + tax) * 20) / 100 + (value_sended + tax)) / 2"));


        $pagos_com_libra = $this->model::whereBetween('created_at', [$start_week, $end_week])
            ->where(["plan" => 0, "currency" => "gbp"])
            ->sum(DB::raw("value_sended + tax"));

        $pagos_com_dolar = $this->model::whereBetween('created_at', [$start_week, $end_week])
            ->where(["plan" => 0, "currency" => "usd"])
            ->sum(DB::raw("value_sended + tax"));

        $pagos_com_euro = $this->model::whereBetween('created_at', [$start_week, $end_week])
            ->where(["plan" => 0, "currency" => "eur"])
            ->sum(DB::raw("value_sended + tax"));

        $dolar_para_euro = $pagos_com_dolar * $this->DOLAR_EURO_PARA / 1;
        $libra_para_euro = $pagos_com_libra *  $this->LIBRA_EURO_PARA / 1;

        $sem_prestacoes = $pagos_com_euro + $dolar_para_euro + $libra_para_euro;
        $com_prestacoes = $pagos_em_prestacoes_com_euro + $dolar_para_euro_prestacoes + $libra_para_euro_prestacoes;

        $semana_passada = $sem_prestacoes + $com_prestacoes;
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
        $pagos_em_prestacoes_com_libra = $this->model::whereMonth('created_at', $mes)
            ->whereYear("created_at", date("Y"))
            ->where(["plan" => 1, "currency" => "gbp"])
            ->sum(DB::raw("(((value_sended + tax) * 20) / 100 + (value_sended + tax)) / 2"));

        $pagos_em_prestacoes_com_dolar = $this->model::whereMonth('created_at', $mes)
            ->whereYear("created_at", date("Y"))
            ->where(["plan" => 1, "currency" => "usd"])
            ->sum(DB::raw("(((value_sended + tax) * 20) / 100 + (value_sended + tax)) / 2"));

        $dolar_para_euro_prestacoes = $pagos_em_prestacoes_com_dolar * $this->DOLAR_EURO_PARA;
        $libra_para_euro_prestacoes = $pagos_em_prestacoes_com_libra * $this->LIBRA_EURO_PARA;

        $pagos_em_prestacoes_com_euro = $this->model::whereMonth('created_at', $mes)
            ->whereYear("created_at", date("Y"))
            ->where(["plan" => 1, "currency" => "eur"])
            ->sum(DB::raw("(((value_sended + tax) * 20) / 100 + (value_sended + tax)) / 2"));

        $pagos_com_libra = $this->model::whereMonth('created_at', $mes)
            ->whereYear("created_at", date("Y"))
            ->where(["plan" => 0, "currency" => "gbp"])
            ->sum(DB::raw("value_sended + tax"));

        $pagos_com_dolar = $this->model::whereMonth('created_at', $mes)
            ->whereYear("created_at", date("Y"))
            ->where(["plan" => 0, "currency" => "usd"])
            ->sum(DB::raw("value_sended + tax"));

        $pagos_com_euro = $this->model::whereMonth('created_at', $mes)
            ->whereYear("created_at", date("Y"))
            ->where(["plan" => 0, "currency" => "eur"])
            ->sum(DB::raw("value_sended + tax"));

        $dolar_para_euro = $pagos_com_dolar * $this->DOLAR_EURO_PARA;
        $libra_para_euro = $pagos_com_libra *  $this->LIBRA_EURO_PARA;

        $sem_prestacoes = $pagos_com_euro + $dolar_para_euro + $libra_para_euro;
        $com_prestacoes = $pagos_em_prestacoes_com_euro + $dolar_para_euro_prestacoes + $libra_para_euro_prestacoes;

        return $sem_prestacoes + $com_prestacoes;
    }

    public function mes_ano_passado($mes)
    {
        $pagos_em_prestacoes_com_libra = $this->model::whereMonth('created_at', '=', $mes)
            ->whereYear('created_at', date('Y', strtotime('-1 year')))
            ->where(["plan" => 1, "currency" => "gbp"])
            ->sum(DB::raw("(((value_sended + tax) * 20) / 100 + (value_sended + tax)) / 2"));

        $pagos_em_prestacoes_com_dolar = $this->model::whereMonth('created_at', '=', $mes)
            ->whereYear('created_at', date('Y', strtotime('-1 year')))
            ->where(["plan" => 1, "currency" => "usd"])
            ->sum(DB::raw("(((value_sended + tax) * 20) / 100 + (value_sended + tax)) / 2"));

        $dolar_para_euro_prestacoes = $pagos_em_prestacoes_com_dolar * $this->DOLAR_EURO_PARA / 1;
        $libra_para_euro_prestacoes = $pagos_em_prestacoes_com_libra * $this->LIBRA_EURO_PARA / 1;

        $pagos_em_prestacoes_com_euro = $this->model::whereMonth('created_at', '=', $mes)
            ->whereYear('created_at', date('Y', strtotime('-1 year')))
            ->where(["plan" => 1, "currency" => "eur"])
            ->sum(DB::raw("(((value_sended + tax) * 20) / 100 + (value_sended + tax)) / 2"));

        $pagos_com_libra = $this->model::whereMonth('created_at', '=', $mes)
            ->whereYear('created_at', date('Y', strtotime('-1 year')))
            ->where(["plan" => 0, "currency" => "gbp"])
            ->sum(DB::raw("value_sended + tax"));

        $pagos_com_dolar = $this->model::whereMonth('created_at', '=', $mes)
            ->whereYear('created_at', date('Y', strtotime('-1 year')))
            ->where(["plan" => 0, "currency" => "usd"])
            ->sum(DB::raw("value_sended + tax"));

        $pagos_com_euro = $this->model::whereMonth('created_at', '=', $mes)
            ->whereYear('created_at', date('Y', strtotime('-1 year')))
            ->where(["plan" => 0, "currency" => "eur"])
            ->sum(DB::raw("value_sended + tax"));

        $dolar_para_euro = $pagos_com_dolar * $this->DOLAR_EURO_PARA / 1;
        $libra_para_euro = $pagos_com_libra *  $this->LIBRA_EURO_PARA / 1;

        $sem_prestacoes = $pagos_com_euro + $dolar_para_euro + $libra_para_euro;
        $com_prestacoes = $pagos_em_prestacoes_com_euro + $dolar_para_euro_prestacoes + $libra_para_euro_prestacoes;

        return $sem_prestacoes + $com_prestacoes;
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

    public function pagos_em_prestacoes_ou_cash($plan)
    {
        $pagos_em_prestacoes_com_libra = $this->model::whereMonth('created_at', date("m"))
            ->whereYear("created_at", date("Y"))
            ->where(["plan" => 1, "currency" => "gbp"])
            ->sum(DB::raw("(((value_sended + tax) * 20) / 100 + (value_sended + tax)) / 2"));

        $pagos_em_prestacoes_com_dolar = $this->model::whereMonth('created_at', date("m"))
            ->whereYear("created_at", date("Y"))
            ->where(["plan" => 1, "currency" => "usd"])
            ->sum(DB::raw("(((value_sended + tax) * 20) / 100 + (value_sended + tax)) / 2"));

        $dolar_para_euro_prestacoes = $pagos_em_prestacoes_com_dolar * $this->DOLAR_EURO_PARA / 1;
        $libra_para_euro_prestacoes = $pagos_em_prestacoes_com_libra * $this->LIBRA_EURO_PARA / 1;

        $pagos_em_prestacoes_com_euro = $this->model::whereMonth('created_at', date("m"))
            ->whereYear("created_at", date("Y"))
            ->where(["plan" => 1, "currency" => "eur"])
            ->sum(DB::raw("(((value_sended + tax) * 20) / 100 + (value_sended + tax)) / 2"));

        $pagos_com_libra = $this->model::whereMonth('created_at', date("m"))
            ->whereYear("created_at", date("Y"))
            ->where(["plan" => 0, "currency" => "gbp"])
            ->sum(DB::raw("value_sended + tax"));

        $pagos_com_dolar = $this->model::whereMonth('created_at', date("m"))
            ->whereYear("created_at", date("Y"))
            ->where(["plan" => 0, "currency" => "usd"])
            ->sum(DB::raw("value_sended + tax"));

        $pagos_com_euro = $this->model::whereMonth('created_at', date("m"))
            ->whereYear("created_at", date("Y"))
            ->where(["plan" => 0, "currency" => "eur"])
            ->sum(DB::raw("value_sended + tax"));

        $dolar_para_euro = $pagos_com_dolar * $this->DOLAR_EURO_PARA / 1;
        $libra_para_euro = $pagos_com_libra *  $this->LIBRA_EURO_PARA / 1;


        if ($plan === 1) {
            return  $pagos_em_prestacoes_com_euro + $dolar_para_euro_prestacoes + $libra_para_euro_prestacoes;
        } else {
            return   $pagos_com_euro + $dolar_para_euro + $libra_para_euro;
        }
    }

    public function transferencias_recentes($month, $year, $limit)
    {
        return $this->model::whereMonth("created_at", $month)->whereYear("created_at", $year)->latest()->limit($limit)->get();
    }

    public function lucro_mensal($mes, $year)
    {
        $pagos_em_prestacoes_com_libra = $this->model::whereMonth('created_at', $mes)
            ->whereYear("created_at", date("Y"))
            ->where(["plan" => 1, "currency" => "gbp"])
            ->sum(DB::raw("(((value_sended + tax) * 20) / 100 + (value_sended + tax)) / 2"));

        $pagos_em_prestacoes_com_dolar = $this->model::whereMonth('created_at', $mes)
            ->whereYear("created_at", date("Y"))
            ->where(["plan" => 1, "currency" => "usd"])
            ->sum(DB::raw("(((value_sended + tax) * 20) / 100 + (value_sended + tax)) / 2"));


        $pagos_em_prestacoes_com_euro = $this->model::whereMonth('created_at', $mes)
            ->whereYear("created_at", date("Y"))
            ->where(["plan" => 1, "currency" => "eur"])
            ->sum(DB::raw("(((value_sended + tax) * 20) / 100 + (value_sended + tax)) / 2"));

        $pagos_com_libra = $this->model::whereMonth('created_at', $mes)
            ->whereYear("created_at", date("Y"))
            ->where(["plan" => 0, "currency" => "gbp"])
            ->sum(DB::raw("value_sended + tax"));

        $pagos_com_dolar = $this->model::whereMonth('created_at', $mes)
            ->whereYear("created_at", date("Y"))
            ->where(["plan" => 0, "currency" => "usd"])
            ->sum(DB::raw("value_sended + tax"));

        $pagos_com_euro = $this->model::whereMonth('created_at', $mes)
            ->whereYear("created_at", date("Y"))
            ->where(["plan" => 0, "currency" => "eur"])
            ->sum(DB::raw("value_sended + tax"));

        $data = [
            "libra" => $pagos_com_libra + $pagos_em_prestacoes_com_libra,
            "euro" => $pagos_com_euro + $pagos_em_prestacoes_com_euro,
            "dolar" => $pagos_com_dolar + $pagos_em_prestacoes_com_dolar
        ];

        return $data;
    }
}
