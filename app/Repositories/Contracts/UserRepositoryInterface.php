<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface{
    public function all();
    public function create($request);
    public function update_avatar($name);
}
