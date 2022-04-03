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

    public function whereTags($tag)
    {
        return $this->model::with(['tags' => function ($q) use ($tag) {
            // Query the name field in status table
            $q->where('name', $tag)->firstOrFail();

        }])->get();
    }
}
