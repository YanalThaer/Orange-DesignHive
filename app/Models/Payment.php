<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'status',
        'payment_method',
        'transaction_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

