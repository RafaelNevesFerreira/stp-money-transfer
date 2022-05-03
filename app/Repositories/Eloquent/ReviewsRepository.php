<?php

namespace App\Repositories\Eloquent;

use App\Models\Reviews;
use App\Repositories\Contracts\ReviewsRepositoryInterface;

class ReviewsRepository extends AbstractRepository implements ReviewsRepositoryInterface
{
    public function __construct(public Reviews $model)
    {
    }
}
