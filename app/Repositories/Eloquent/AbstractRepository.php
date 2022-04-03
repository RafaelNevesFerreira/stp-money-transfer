<?php

namespace App\Repositories\Eloquent;


class AbstractRepository
{
    public function all()
    {
        return $this->model::latest()->get();
    }
}
