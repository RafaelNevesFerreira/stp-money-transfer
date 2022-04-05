<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "address",
        "country",
        "phone_number",
        "email",
        "value_sended",
        "receveid_at",
        "destinatary_name",
        "transfer_code",
        "status",
    ];
}
