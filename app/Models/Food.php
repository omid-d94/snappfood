<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Food extends Model
{
    use HasFactory;

    protected $table = "foods";
    protected $guarded = [];

    /**
     * Relationship between restaurant and food is one to many
     * @return BelongsTo
     */
    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class, "restaurant_id");
    }

    /**
     * Relationship between category and food is one to many
     * @return BelongsTo
     */
    public function foodCategory(): BelongsTo
    {
        return $this->belongsTo(FoodCategory::class, "food_category");
    }

    /**
     * Relationship between food and cart is many to many
     * @return BelongsToMany
     */
    public function carts(): BelongsToMany
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
     * @return BelongsToMany
     */
    public function orders(): BelongsToMany
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
     * @return BelongsTo
     */
    public function discount(): BelongsTo
    {
        return $this->belongsTo(Discount::class, "discount_id");
    }

    /**
     * Relationship between food and food-party is many to many
     * @return BelongsToMany
     */
    public function foodParties(): BelongsToMany
    {
        return $this->belongsToMany(
            related: FoodParty::class,
            table: "food_food_party",
            foreignPivotKey: "food_id",
            relatedPivotKey: "food_party_id")
            ->withPivot("count", "discount_id");
    }
}
