<?php

namespace App\Repositories\Contracts;

interface PostsRepositoryInterface{
    public function all_posts();
    public function whereSlug($slug);
    public function whereTag($tag);
}
