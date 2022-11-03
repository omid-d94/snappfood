<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public function foods()
    {
        return $this->belongsToMany(
            Food::class,
            "cart_food",
            "cart_id",
            "food_id"
        );
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
