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
        $cards_id = $this->cards->ifExist(session("data")["card_no"]);

        if ($cards_id != null) {
            $cards_id = $cards_id;
        }else{
            $cards_id = null;
        }
        $this->model::create([
            "name" => session("name"),
            "cards_id" => $cards_id,
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
