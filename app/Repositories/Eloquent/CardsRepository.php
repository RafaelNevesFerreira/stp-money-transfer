<?php

namespace App\Repositories\Eloquent;

use App\Models\Cards;
use Wink\WinkTag;
use App\Repositories\Contracts\CardsRepositoryInterface;

class CardsRepository extends AbstractRepository implements CardsRepositoryInterface
{
    public $model;
    public function __construct()
    {
        $this->model = new Cards();
    }

    public function ifExist($card_number){
        $card = $this->model::where("card_number",$card_number)->first();

        if ($card == null) {
            return null;
        }else{
            return $card->id;
        }
    }


}
