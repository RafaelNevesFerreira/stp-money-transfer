<?php

namespace App\Repositories\Contracts;

interface FaqRepositoryInterface
{
    public function all();
    public function create($request);
}
