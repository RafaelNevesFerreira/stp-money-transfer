<?php

namespace App\Repositories\Eloquent;

use Wink\WinkPost;
use App\Repositories\Contracts\PostsRepositoryInterface;

class PostsRepository extends AbstractRepository implements PostsRepositoryInterface
{
    public $model;
    public function __construct()
    {
        $this->model = new WinkPost();
    }

    public function all_posts()
    {
        return $this->model::latest()->paginate(1);
    }
}
