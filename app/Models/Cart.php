<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = "carts";
    protected $fillable = ["user_id", "restaurant_id"];

    public function foods()
    {
        return $this->belongsToMany(
            Food::class,
            "cart_food",
            "cart_id",
            "food_id"
        )->withPivot("count");
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /* Relationship between user and cart is one to many */
    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    /* Relationship between restaurant and cart is one to many */
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, "restaurant_id");
    }
}
