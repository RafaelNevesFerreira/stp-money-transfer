<?php

namespace App\Repositories\Eloquent;

use App\Models\Faq;
use App\Repositories\Contracts\FaqRepositoryInterface;

class FaqRepository extends AbstractRepository implements FaqRepositoryInterface
{
    public function __construct(public Faq $model)
    {
    }

    public function delete($id)
    {
        $this->model::where('id', $id)->delete();
    }

    public function metade($metade, $total)
    {
        return $this->model::whereBetween("id", [$metade, $total])->get();
    }
}
