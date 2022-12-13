<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CartFood extends Pivot
{
    use HasFactory;

    protected $table = "cart_food";
    protected $fillable = ["count", "food_id", "cart_id"];

}
