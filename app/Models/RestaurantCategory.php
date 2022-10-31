<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class RestaurantCategory extends Model
{
    use HasFactory;

    protected $fillable = ["name", "image_path", "slug"];

    public function restaurants()
    {
        return $this->hasMany(Restaurant::class, "type", "id");
    }

    public function name(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Str::title($value),
            set: fn($value) => strtolower($value)
        );
    }
}
