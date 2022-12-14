<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = ["title", "logo", "phone", "address", "type", "send_cost",
        "schedule", "account", "is_open", "score", "latitude", "longitude", "seller_id", "status"];

    protected $casts = [
        "is_open" => "boolean",
        "status" => "boolean"
    ];


    /**
     * Relationship between Category and restaurant is one to many
     * @return BelongsTo
     */
    public function restaurantCategory()
    {
        return $this->belongsTo(RestaurantCategory::class, "type", "id");
    }

    /**
     * Relationship between Food Category adn Restaurant is Many to Many
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function foodCategories()
    {
        return $this->belongsToMany(
            FoodCategory::class,
            "food_category_restaurant",
            "restaurant_id",
            "food_category_id"
        );
    }

    /**
     * Relationship between restaurant and food  is One to many
     * @return HasMany
     */
    public function foods()
    {
        return $this->hasMany(Food::class, "restaurant_id");
    }

    /**
     * Relationship between restaurant and working time is one to many
     * @return HasMany
     */
    public function workingTimes()
    {
        return $this->hasMany(WorkingTime::class, "restaurant_id");
    }

    /**
     * Relationship between restaurant and cart is one to many
     * @return HasMany
     */
    public function carts()
    {
        return $this->hasMany(Cart::class, "restaurant_id");
    }

    /**
     * Relationship between restaurant and order is one to many
     * @return HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class, "restaurant_id");
    }

    /**
     * Relationship between restaurant and comment is has many through
     * @return HasManyThrough
     */
    public function comments()
    {
        return $this->hasManyThrough(
            Comment::class,
            Order::class,
            "restaurant_id",
            "order_id"
        );
    }

    /**
     * Relationship between seller and restaurant is one to many
     * @return BelongsTo
     */
    public function seller()
    {
        return $this->belongsTo(Seller::class, "seller_id");
    }

    /**
     * Displaying send cost equal to zero as free
     * @return Attribute
     */
    public function sendCost(): Attribute
    {
        return Attribute::make(
            get: fn($value) => ($value == 0) ? "Free" : $value,
            set: fn($value) => ($value == "Free") ? 0 : $value
        );
    }

    /**
     * use accessor for is_open property
     * true -> open , false -> close
     * @return Attribute
     */
    public function isOpen(): Attribute
    {
        return Attribute::make(
            get: fn($value) => (!$value) ? "Close" : "Open"
        );
    }

    /**
     * query scope for is_open property
     *
     * @param $query
     * @param $isOpen
     * @return mixed
     */
    public function scopeRestaurantIsOpen($query, $isOpen)
    {
        return $query->where("is_open", $isOpen);
    }

    /**
     * query scope for type property
     *
     * @param $query
     * @param $type
     * @return mixed
     */
    public function scopeType($query, $type)
    {
        return $query->where("type", $type);
    }

    /**
     * query scope for score greater than a value
     *
     * @param $query
     * @param $score
     * @return mixed
     */
    public function scopeScoreGreaterThan($query, $score)
    {
        return $query->where("score", ">", $score);
    }
}
