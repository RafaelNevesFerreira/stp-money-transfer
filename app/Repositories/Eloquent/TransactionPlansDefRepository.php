<?php

namespace App\Repositories\Eloquent;

use Wink\WinkTag;
use App\Repositories\Contracts\TransactionPlansDefInterface;

class TransactionPlansDefRepository extends AbstractRepository implements TransactionPlansDefInterface
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
