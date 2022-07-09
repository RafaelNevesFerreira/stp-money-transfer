<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{

    use HasFactory;

    protected $fillable = [
        "name",
        "currency",
        "address",
        "country",
        "phone_number",
        "email",
        "value_sended",
        "received_at",
        "payment_method",
        "tax",
        "destinatary_name",
        "transfer_code",
        "status",
    ];

    public function receptor()
    {
        return $this->hasOne(TransferReception::class);
    }

    public function comprovative_user()
    {
        return $this->hasOneThrough(
            User::class,
            TransferComprovative::class,
            'transfer_id', // Foreign key on the cars table...
            'id', // Foreign key on the owners table...
            'id', // Local key on the mechanics table...
            'id' // Local key on the cars table...
        );
    }

    public function comprovative()
    {
        return $this->hasOne(TransferComprovative::class);
    }
}
