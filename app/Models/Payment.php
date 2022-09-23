<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'payment_date', 'expires_at', 'status', 'user_id', 'clp_usd'];

    public function client()
    {
        return $this->belongsTo(Client::class, 'user_id');
    }
}
