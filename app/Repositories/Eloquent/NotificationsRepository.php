<?php

namespace App\Repositories\Eloquent;

use App\Models\Notification;
use App\Repositories\Contracts\NotificationsRepositoryInterface;

class NotificationsRepository extends AbstractRepository implements NotificationsRepositoryInterface
{
    public function __construct(public Notification $model)
    {
    }
}
