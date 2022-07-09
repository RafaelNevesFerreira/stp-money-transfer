<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferComprovative extends Model
{
    use HasFactory;

    public function transfers()
    {
        return $this->belongsTo(Transfer::class);

    }
}
