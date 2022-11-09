<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FoodCategory extends Model
{
    use HasFactory;

    protected $fillable = ["title", "slug", "image_path"];

    /**
     * Relationship between food category and food is one to many
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function foods()
    {
        return $this->hasMany(Food::class,"food_category");
    }


    public function title(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Str::title($value),
            set: fn($value) => strtolower($value)
        );
    }

    /**
     * Relationship between Food Category and Restaurant is Many to Many
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function restaurants()
    {
        return $this->belongsToMany(
            Restaurant::class,
            "food_category_restaurant",
            "food_category_id",
            "restaurant_id"
        );
    }
}
