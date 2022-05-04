<?php

namespace App\Repositories\Contracts;

interface ContactRepositoryInterface
{
    public function firstorfail($id);
    public function update($id,$request);
}
