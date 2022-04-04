<?php

namespace App\Repositories\Contracts;

interface PostsRepositoryInterface{
    public function all();
    public function whereSlug($slug);
    public function whereTag($tag);
}
