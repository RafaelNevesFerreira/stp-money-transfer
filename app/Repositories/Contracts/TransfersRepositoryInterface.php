<?php

namespace App\Repositories\Contracts;

interface TransfersRepositoryInterface{
    public function all();
    public function store();
    public function get_by_user_email();
    public function details($id);
    public function received_this_month();
    public function reimbursed_this_month();
    public function abonement_this_month();
    public function to_received_this_month();
}
