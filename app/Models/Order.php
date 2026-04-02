<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'order_code',
        'channel',
        'status',
        'customer_name',
        'total',
        'item_count',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
