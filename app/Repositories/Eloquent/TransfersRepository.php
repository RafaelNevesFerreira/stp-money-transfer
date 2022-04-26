<?php

namespace App\Repositories\Eloquent;

use App\Models\Transfer;
use App\Pipes\DateFilter;
use App\Pipes\StatusFilter;
use App\Jobs\PaimentSuccess;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pipeline\Pipeline;
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
        }else{
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
}
