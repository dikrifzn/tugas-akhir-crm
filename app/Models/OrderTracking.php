<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderTracking extends Model
{
    protected $fillable = ['order_id', 'status', 'location', 'logged_at'];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
