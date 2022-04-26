<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface{
    public function all();
    public function create();
    public function update_avatar($name);
}
