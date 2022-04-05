<?php

namespace App\Repositories\Eloquent;

use App\Models\Transfer;
use App\Repositories\Contracts\CardsRepositoryInterface;
use Wink\WinkTag;
use App\Repositories\Contracts\TransfersRepositoryInterface;

class TransfersRepository extends AbstractRepository implements TransfersRepositoryInterface
{
    public $model;
    public function __construct(public CardsRepositoryInterface $cards)
    {
        $this->model = new Transfer();
    }

    public function store()
    {

        $this->model::create([
            "name" => session("name"),
            "address" => session("address"),
            "country" => session("country"),
            "phone_number" => session("phone_number"),
            "email" => session("email"),
            "value_sended" => session("valor_a_ser_enviado"),
            "destinatary_name" => session("receptor"),
            "transfer_code" => uniqid("SMT"),
        ]);
    }
}
