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
}
