<?php

namespace App\Repositories\Eloquent;

use App\Models\Faq;
use App\Repositories\Contracts\FaqRepositoryInterface;

class FaqRepository extends AbstractRepository implements FaqRepositoryInterface
{
    public function __construct(public Faq $model)
    {
    }

}
