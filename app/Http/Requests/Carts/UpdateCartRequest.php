<?php

namespace App\Http\Requests\Carts;

use App\Models\Cart;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateCartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $cart = Cart::find($this->route("cart"));
        if ($cart) {
            return auth()->user()->id === $cart->user_id;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "food_id" => ["required", "exists:foods,id"],
            "count" => ["required", "numeric", "max:100"]
        ];
    }
}
