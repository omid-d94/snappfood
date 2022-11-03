<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingTime extends Model
{
    use HasFactory;

    protected $fillable = ['start', 'end', 'day','restaurant_id'];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, "restaurant_id");
    }
}
