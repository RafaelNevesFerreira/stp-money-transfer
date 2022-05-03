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

    public function whereTag($tag)
    {
        return $this->model::with("posts")->where("slug", $tag)->paginate(6)->firstOrFail();
    }

    public function create($request)
    {
        $this->model::create($request);
    }

    public function whereId($id)
    {
        return $this->model::where("id", $id)->firstOrFail();
    }

    public function update($id, $request)
    {
        $this->model::where("id", $id)->firstOrFail()->update($request);
    }

    public function limit($limit)
    {
        return $this->model::limit($limit)->latest()->get();
    }

    public function simplePaginate($limit)
    {
        return $this->model::paginate($limit);
    }
}
