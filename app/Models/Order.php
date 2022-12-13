<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory, SoftDeletes;

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
     * Relationship between order and comment is one to one
     * @return HasOne
     */
    public function comment()
    {
        return $this->hasOne(Comment::class, "order_id")
            ->whereNull("comments.deleted_at");
    }

    /**
     * Relationship between cart and order is one to one
     * @return HasOne
     */
    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    /**
     * make accessor for status attribute
     *
     * @return Attribute
     */
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

    /**
     * make accessor for total attribute
     *
     * @return Attribute
     */
    public function total(): Attribute
    {
        return Attribute::make(get: fn($value) => number_format(
            $value,
            decimals: 0,
            decimal_separator: "",
            thousands_separator: ','));
    }

    /**
     *Get orders last week
     *
     * @param $query
     * @return mixed
     */
    public function scopeFilterByWeek($query): mixed
    {
        return $query->whereBetween("created_at", [now()->subWeek(), now()]);
    }

    /**
     * Get orders last month
     *
     * @param $query
     * @return mixed
     */
    public function scopeFilterByMonth($query): mixed
    {
        return $query->whereBetween("created_at", [now()->subMonth(), now()]);
    }

    /**
     * Get orders when created at between two dates
     *
     * @param $query
     * @param $from
     * @param $to
     * @return mixed
     */
    public function scopeBetweenTwoDates($query, $from, $to): mixed
    {
        return $query->whereBetween("created_at", [$from, $to]);
    }

    /**
     * Select total income corresponding to date
     *
     * @param $query
     * @return mixed
     */
    public function scopeSelectTotalAndDate($query): mixed
    {
        return $query->select(
            [
                DB::raw("SUM(total) as total"),
                DB::raw("Date(created_at) as date")
            ]);
    }

    /**
     * Select count and date of orders
     * @param $query
     * @return mixed
     */
    public function scopeSelectCountAndDate($query): mixed
    {
        return $query->select(
            [
                DB::raw("COUNT(*) as count"),
                DB::raw("Date(created_at) as date")
            ]);
    }

    /**
     * grouping orders by created date
     * @param $query
     * @return mixed
     */
    public function scopeGroupByCreateAtDate($query): mixed
    {
        return $query->groupBy(DB::raw("Date(created_at)"));
    }

    /**
     * Select count orders corresponding to month name
     *
     * @param $query
     * @return mixed
     */
    public function scopeSelectCountAndMonthName($query): mixed
    {
        return $query->select(
            [
                DB::raw("COUNT(*) as count"),
                DB::raw("MONTHNAME(created_at) as month_name")
            ]);
    }

    /**
     * Select income orders corresponding to month name
     * @param $query
     * @return mixed
     */
    public function scopeSelectTotalAndMonthName($query): mixed
    {
        return $query->select(
            [
                DB::raw("SUM(total) as income"),
                DB::raw("MONTHNAME(created_at) as month_name")
            ]);
    }

    /**
     * group orders by month name of created date
     * @param $query
     * @return mixed
     */
    public function scopeGroupByMonthName($query): mixed
    {
        return $query->groupBy(DB::raw("MONTHNAME(created_at)"));
    }
}
