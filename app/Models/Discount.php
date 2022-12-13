<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = ["title", "code", "percent", "expired_at", "factor"];

    /**
     * Relationship between discount and food is one to many
     * @return HasMany
     */
    public function foods(): HasMany
    {
        return $this->hasMany(Food::class, "discount_id");
    }

    /**
     * Relationship between discount and food-foodParty is one to many
     * @return HasMany
     */
    public function foodFoodParties(): HasMany
    {
        return $this->hasMany(FoodFoodParty::class, "discount_id");
    }

    /**
     * make code of discount on uppercase
     * @return Attribute
     */
    public function code(): Attribute
    {
        return Attribute::make(
            get: fn($value) => strtoupper($value),
            set: fn($value) => strtoupper($value)
        );
    }

}
