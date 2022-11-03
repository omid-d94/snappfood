<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingTime extends Model
{
    use HasFactory;

    protected $fillable = ['start', 'end', 'day'];

    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class,
            "restaurant_working_time",
            "working_time_id",
            "restaurant_id");
    }
}
