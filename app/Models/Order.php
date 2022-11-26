<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = "orders";
    protected $fillable = ["status", "total", "user_id", "restaurant_id", "tracking_code"];

    public const PENDING = 1;
    public const PREPARING = 2;
    public const SEND_TO_DESTINATION = 3;
    public const DELIVERED = 4;

    protected $casts = [
        "created_at" => "datetime",
        "updated_at" => "datetime",
        "status" => "integer"
    ];

    /**
     * Relationship between order and food in many to many
     * with count field in pivot table 'food_order'
     */
    public function foods()
    {
        return $this->belongsToMany(
            Food::class,
            "food_order",
            "order_id",
            "food_id",
        )->withPivot("count");
    }

    /**
     * Relationship between restaurant and order is one to many
     * @return BelongsTo
     */
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, "restaurant_id");
    }

    /**
     *  Relationship between user and order is one to many
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    /**
     * Relationship between cart and order is one to one
     * @return HasOne
     */
    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    public function status(): Attribute
    {
        return Attribute::make(get: fn($value) => match ($value) {
            self::PENDING => "PENDING",
            self::PREPARING => "PREPARING",
            self::SEND_TO_DESTINATION => "SEND_TO_DESTINATION",
            self::DELIVERED => "DELIVERED",
            default => "No Match!"
        });
    }

    public function total(): Attribute
    {
        return Attribute::make(get: fn($value) => number_format(
            $value,
            decimals: 0,
            decimal_separator: "",
            thousands_separator: ','));
    }
}
