<?php

namespace App\Repositories\Eloquent;

use App\Jobs\PaimentSuccess;
use App\Models\Transfer;
use App\Repositories\Contracts\TransfersRepositoryInterface;
use Illuminate\Support\Facades\Auth;

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
        $this->model::create([
            "name" => session("name"),
            "address" => session("address"),
            "currency" => $currency,
            "country" => session("country"),
            "phone_number" => session("phone_number"),
            "plan" => $plan,
            "email" => session("email"),
            "value_sended" => session("valor_a_ser_enviado"),
            "destinatary_name" => session("receptor"),
            "transfer_code" => $transfer_code,
        ]);

        PaimentSuccess::dispatch(session("email"), session("name"), $transfer_code, session("receptor"))->delay(now());
    }

    public function get_by_user_email()
    {
        return $this->model::Where("email",Auth::user()->email)->get();
    }
}
