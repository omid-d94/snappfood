<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = ["title", "latitude", "longitude", "address", "default"];

    protected $casts = ["default" => "boolean"];

    public const DISTANCE_MATRIX_URL = "https://api.neshan.org/v1/distance-matrix/no-traffic";
    public const API_KEY = "service.35586f8937cf45bba7b71ca4a29e7cab";
    public const ORIGINS = "origins";
    public const DESTINATIONS = "destinations";
    public const VEHICLE_TYPE = "motorcycle";
    public const TYPE = "type";
    public const COMMA = ",";


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
