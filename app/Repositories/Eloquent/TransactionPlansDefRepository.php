<?php

namespace App\Repositories\Eloquent;

use App\Models\TransactionPlansDef;
use App\Repositories\Contracts\TransactionPlansDefInterface;

class TransactionPlansDefRepository extends AbstractRepository implements TransactionPlansDefInterface
{
    public function __construct(public TransactionPlansDef $model)
    {
    }

    public function get($attribute)
    {
        return $this->model::where("id",1)->first($attribute);
    }
}
