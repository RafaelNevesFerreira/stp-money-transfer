<?php

namespace App\Repositories\Eloquent;

use App\Models\Transfer;
use Wink\WinkTag;
use App\Repositories\Contracts\TransfersRepositoryInterface;

class TransfersRepository extends AbstractRepository implements TransfersRepositoryInterface
{
    public $model;
    public function __construct()
    {
        $this->model = new Transfer();
    }
}
