<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function foods()
    {
        return $this->belongsToMany(
            Food::class,
            "food_order",
            "order_id",
            "food_id",
        );
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }
}
