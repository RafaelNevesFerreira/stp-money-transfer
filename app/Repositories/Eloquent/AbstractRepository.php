<?php

namespace App\Repositories\Eloquent;


class AbstractRepository
{
    public function all()
    {
        return $this->model::latest()->get();
    }

    public function whereSlug($slug)
    {
        return $this->model::whereSlug($slug)->firstOrFail();
    }
}
