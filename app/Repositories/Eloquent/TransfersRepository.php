<?php

namespace App\Repositories\Eloquent;

use App\Models\Transfer;
use App\Pipes\DateFilter;
use App\Pipes\StatusFilter;
use App\Jobs\PaimentSuccess;
use Illuminate\Support\Carbon;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Contracts\TransfersRepositoryInterface;

class TransfersRepository extends AbstractRepository implements TransfersRepositoryInterface
{
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

        $diferença = ($valor_final - $valor_inicial) / $valor_inicial * 100;

        return $diferença;
    }

}
