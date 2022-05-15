<?php

namespace App\Repositories\Eloquent;

use App\Models\Notification;
use App\Repositories\Contracts\NotificationsRepositoryInterface;

class NotificationsRepository implements NotificationsRepositoryInterface
{
    public function __construct(public Notification $model)
    {
    }

    public function whereId($id)
    {
        return $this->model::where("users_id", $id)->latest()->get();
    }
}
