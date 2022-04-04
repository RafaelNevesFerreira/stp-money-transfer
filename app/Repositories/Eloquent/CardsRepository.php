<?php

namespace App\Repositories\Eloquent;

use App\Models\Cards;
use Illuminate\Support\Facades\Crypt;
use App\Repositories\Contracts\CardsRepositoryInterface;

class CardsRepository extends AbstractRepository implements CardsRepositoryInterface
{
    public $model;
    public function __construct()
    {
        $this->model = new Cards();
    }

    public function ifExist($card_number){
        // $card_number = Crypt::encrypt($card_number);
        dd(Crypt::encryptString($card_number));
        $card = $this->model::where("card_number",$card_number)->first();
        dd(Crypt::decrypt($card->card_number));
        if ($card == null) {
            return null;
        }else{
            return $card->id;
        }
    }


}
