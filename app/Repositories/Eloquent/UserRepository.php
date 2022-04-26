<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{

    public function __construct(public User $model)
    {
    }

    public function update_avatar($name)
    {
        $this->model::where("id", Auth::user()->id)->update([
            "avatar" => $name
        ]);
    }
}
