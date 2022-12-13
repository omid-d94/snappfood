<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class FoodOrder extends Pivot
{
    use HasFactory;

    protected $table = "food_order";
    protected $fillable = ["count", "food_id", "order_id"];
}
