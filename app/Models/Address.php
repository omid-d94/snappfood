<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = ["title", "latitude", "longitude", "address", "default"];

    protected $casts = ["default" => "boolean"];

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            "address_user",
            "address_id",
            "user_id"
        );
    }
}
