<?php

namespace App\Repositories\Eloquent;

class AbstractRepository
{
    public function all()
    {
        return $this->model::query()->when(request()->has("title"), function ($query) {
            $query->where("title", "like","%". request("title") . "%");
        })->latest()->get();
    }

    public function whereSlug($slug)
    {
        return $this->model::whereSlug($slug)->firstOrFail();
    }

    public function whereTag($tag)
    {
        return $this->model::with("posts")->where("slug", $tag)->firstOrFail();
    }
}
