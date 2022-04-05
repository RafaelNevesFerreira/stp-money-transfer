<?php

namespace App\Repositories\Eloquent;

use App\Models\Transfer;
use App\Repositories\Contracts\CardsRepositoryInterface;
use Wink\WinkTag;
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
        $this->model::create([
            "name" => session("name"),
            "address" => session("address"),
            "currency" => $currency,
            "country" => session("country"),
            "phone_number" => session("phone_number"),
            "email" => session("email"),
            "value_sended" => session("valor_a_ser_enviado"),
            "destinatary_name" => session("receptor"),
            "transfer_code" => uniqid("SMT"),
        ]);
    }
}
