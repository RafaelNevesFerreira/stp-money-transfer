<?php

namespace App\Repositories\Contracts;

interface FaqRepositoryInterface
{
    public function all();
    public function create($request);
    public function delete($id);
    public function whereId($id);
}
