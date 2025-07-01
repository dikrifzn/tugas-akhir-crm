<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingAddresses extends Model
{
    protected $fillable = [
        'user_id', 'recipient_name', 'phone', 'address',
        'province', 'city', 'postal_code'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
