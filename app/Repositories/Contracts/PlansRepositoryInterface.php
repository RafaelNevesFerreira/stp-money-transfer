<?php

namespace App\Repositories\Contracts;

interface PlansRepositoryInterface{
    public function all();
    public function store();
    public function ifExist();
}
