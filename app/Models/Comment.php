<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "comments";
    protected $fillable = ["order_id", "score", "message", "answer", "is_confirmed"];

    protected $casts = array(
        "is_confirmed" => "boolean",
        "created_at" => 'datetime',
        "updated_at" => 'datetime',
    );

    /**
     * Relationship between order and comment is one to one
     * @return BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class, "order_id")
            ->whereNotNull("orders.deleted_at");
    }
}
