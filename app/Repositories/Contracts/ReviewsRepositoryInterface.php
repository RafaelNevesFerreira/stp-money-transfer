<?php

namespace App\Repositories\Contracts;

interface ReviewsRepositoryInterface
{
    public function all();
    public function create($request);
    public function whereId($id);
    public function limit($limit);
    public function simplePaginate();
}
