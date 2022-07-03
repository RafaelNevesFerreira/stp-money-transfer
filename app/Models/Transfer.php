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
}
