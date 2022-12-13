<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FoodFoodParty extends Model
{
    use HasFactory;

    protected $table = "food_food_party";
    protected $fillable = ["food_id", "food_party_id", "count", "discount_id"];

    /**
     * Relationship between discount and Food-FoodParty is one to many
     * @return BelongsTo
     */
    public function discount(): BelongsTo
    {
        return $this->belongsTo(Discount::class, "discount_id");
    }
}
