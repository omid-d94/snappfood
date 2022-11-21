<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    use HasFactory;

    protected $table = "carts";
    protected $fillable = ["user_id", "restaurant_id"];

    public function foods()
    {
        return $this->belongsToMany(
            Food::class,
            "cart_food",
            "cart_id",
            "food_id"
        )->withPivot("count");
    }

    /**
     * Relationship between order and cart is one to one
     *
     * @return BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Relationship between user and cart is one to many
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    /**
     *  Relationship between restaurant and cart is one to many
     *
     * @return BelongsTo
     */
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, "restaurant_id");
    }

    /**
     * receive total price for payment
     *
     * @param Cart $cart
     * @return int
     */
    public static function paymentCart(Cart $cart): int
    {
        $total = 0;
        foreach (CartFood::where("cart_id", $cart->id)->get() as $item) {
            $total += Food::find($item->food_id)->price * $item->count;
        }
        return $total;
    }
}
