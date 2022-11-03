<?php

namespace App\Models;

use App\Http\Controllers\Admin\RestaurantCategoryController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = ["title", "logo", "phone", "address", "type",
        "schedule", "is_open", "score", "latitude", "longitude", "seller_id", "status"];

    public function restaurantCategory()
    {
        return $this->belongsTo(RestaurantCategory::class, "type", "id");
    }

    public function workingTimes()
    {
        return $this->belongsToMany(
            WorkingTime::class,
            "restaurant_working_time",
            "restaurant_id",
            "working_time_id");
    }

    protected $casts = [
        "is_open" => "boolean",
        "status" => "boolean"
    ];

    public function seller()
    {
        $this->belongsTo(Seller::class, "seller_id");
    }
}
