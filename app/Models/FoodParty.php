<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class FoodParty extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "food_parties";
    protected $fillable = ["start", "end"];

    /**
     * Relationship between food and food party is many to many
     * @return BelongsToMany
     */
    public function foods(): BelongsToMany
    {
        return $this->belongsToMany(related: Food::class,
            table: "food_food_parties",
            foreignPivotKey: "food_party_id",
            relatedPivotKey: "food_id")
            ->withPivot("count", "discount_id");
    }
}
