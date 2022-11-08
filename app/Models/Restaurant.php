<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function restaurantCategory()
    {
        return $this->belongsTo(RestaurantCategory::class, "type", "id");
    }

    /**
     * Relationship between restaurant and food  is One to many
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function foods()
    {
        return $this->hasMany(Food::class, "restaurant_id");
    }

    /**
     * Relationship between restaurant and working time is one to many
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function workingTimes()
    {
        return $this->hasMany(WorkingTime::class, "restaurant_id");
    }

    /**
     * Relationship between seller and restaurant is one to many
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seller()
    {
        return $this->belongsTo(Seller::class, "seller_id");
    }

    public function sendCost(): Attribute
    {
        return Attribute::make(
            get: fn($value) => ($value == 0) ? "Free" : $value,
            set: fn($value) => ($value == "Free") ? 0 : $value
        );
    }

    public function isOpen(): Attribute
    {
        return Attribute::make(
            get: fn($value) => (!$value) ? "Close" : "Open"
        );
    }
}
