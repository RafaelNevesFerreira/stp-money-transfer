<?php

namespace App\Repositories\Contracts;

interface FaqRepositoryInterface
{
    public function all();
    public function create($request);
    public function delete($id);
    public function whereId($id);
    public function update($id, $request);
    public function metade($metade, $total);
    public function simplePaginate($limit);
}
