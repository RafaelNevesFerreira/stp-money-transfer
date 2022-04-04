<?php

namespace App\Repositories\Eloquent;

use Wink\WinkTag;
use App\Repositories\Contracts\TagsRepositoryInterface;

class TagsRepository extends AbstractRepository implements TagsRepositoryInterface
{
    public $model;
    public function __construct()
    {
        $this->model = new WinkTag();
    }

    public function all_tags()
    {
        return $this->model::get();
    }


}
