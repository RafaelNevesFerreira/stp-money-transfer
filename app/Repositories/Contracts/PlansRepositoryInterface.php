<?php

namespace App\Repositories\Contracts;

interface PlansRepositoryInterface{
    public function all();
    public function ifExist();
}
