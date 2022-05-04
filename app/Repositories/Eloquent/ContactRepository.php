<?php

namespace App\Repositories\Eloquent;

use App\Models\Contact;
use App\Repositories\Contracts\ContactRepositoryInterface;

class ContactRepository extends AbstractRepository implements ContactRepositoryInterface
{
    public function __construct(public Contact $model)
    {
    }
}
