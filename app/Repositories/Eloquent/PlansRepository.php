<?php

namespace App\Repositories\Eloquent;

use App\Models\Plans;
use Wink\WinkPost;
use App\Repositories\Contracts\PlansRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class PlansRepository extends AbstractRepository implements PlansRepositoryInterface
{
    public $model;
    public function __construct()
    {
        $this->model = new Plans();
    }

    public function ifExist()
    {
        if (Auth::check()) {
            return $this->model::where("users_id",Auth::user()->id)->firstOrFail()->count();
        }else{
            return redirect()->route("payment")->withErrors("Desculpe, Para poder pagar em prestações deve estra cadastrado");
        }
    }
}
