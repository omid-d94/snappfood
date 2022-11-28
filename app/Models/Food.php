<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $table = "foods";
    protected $guarded = [];

    /**
     * Relationship between restaurant and food is one to many
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, "restaurant_id");
    }

    /**
     * Relationship between category and food is one to many
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function foodCategory()
    {
        return $this->belongsTo(FoodCategory::class, "food_category");
    }

    /**
     * Relationship between food and cart is many to many
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function carts()
    {
        return $this->belongsToMany(
            Cart::class,
            "cart_food",
            "food_id",
            "cart_id"
        )->withPivot("count");
    }

    /**
     * Relationship between food and order is many to many
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders()
    {
        return $this->belongsToMany(
            Order::class,
            "food_order",
            "food_id",
            "order_id"
        )->withPivot("count");
    }

    /**
     * Relationship between discount and food  is on to many
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function discount()
    {
        return $this->belongsTo(Discount::class, "discount_id");
    }
}
