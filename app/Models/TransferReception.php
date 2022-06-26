<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferReception extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "last_name",
        "nationality",
        "birthday_date",
        "transfer_id",
    ];


    public function transfers()
    {
        return $this->belongsTo(Transfer::class);
    }
}
