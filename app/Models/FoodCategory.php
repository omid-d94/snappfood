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

    public function foods()
    {
        return $this->hasMany(Food::class);
    }


    public function title(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Str::title($value),
            set: fn($value) => strtolower($value)
        );
    }
}
