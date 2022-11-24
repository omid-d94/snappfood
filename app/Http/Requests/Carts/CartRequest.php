<?php

namespace App\Http\Requests\Carts;

use App\Models\Cart;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class CartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        $cart_id = $this->input("cart_id");
        $cart = Cart::find($cart_id);
        if ($cart) {
            return auth()->user()->id === $cart->user_id;
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            "food_id" => ["required", "exists:foods,id"],
            "count" => ["required", "numeric", "max:100"],
            "cart_id" => ["exists:carts,id"],
        ];
    }

    public function messages(): array
    {
        return [
            "food_id.exists" => "The food is not acceptable",
            "cart_id.exists" => "The cart is not acceptable",
        ];
    }

}
