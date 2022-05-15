<?php

namespace App\Repositories\Contracts;

interface NotificationsRepositoryInterface
{
    public function whereId($id);
    public function save($transfer);
}
