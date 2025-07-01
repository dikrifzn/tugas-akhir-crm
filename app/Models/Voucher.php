<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillable = [
        'code', 'name', 'type', 'value', 'min_purchase', 'expired_at'
    ];

    public function isValid()
    {
        return !$this->expired_at || $this->expired_at > now();
    }

    public function apply($subtotal)
    {
        if ($this->type === 'percentage') {
            return $subtotal * ($this->value / 100);
        }

        return $this->value;
    }
}
