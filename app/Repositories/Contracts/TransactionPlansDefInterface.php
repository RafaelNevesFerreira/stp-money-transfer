<?php

namespace App\Repositories\Contracts;

interface TransactionPlansDefInterface
{
    public function firstorfail($id);
    public function update($id,$request);
    public function get($attribut);
}
