<?php

namespace App\Repositories\Contracts;

interface TransactionPlansDefInterface
{
    public function firstorfail($id);
    public function create($request);
}
