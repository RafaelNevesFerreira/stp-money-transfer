<?php

namespace App\Repositories\Contracts;

interface TransfersRepositoryInterface{
    public function all();
    public function store();
    public function get_by_user_email();
    public function details($id);
}
