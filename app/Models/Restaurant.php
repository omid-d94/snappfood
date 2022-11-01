<?php

namespace App\Models;

use App\Http\Controllers\Admin\RestaurantController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function restaurantCategory()
    {
        return $this->belongsTo(RestaurantCategory::class, "type", "id");
    }
}
