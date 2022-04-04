<?php

namespace App\Repositories\Contracts;

interface CardsRepositoryInterface{
    public function all();
    public function ifExist($card_number);
}
