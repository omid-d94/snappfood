<?php

namespace App\Http\Requests\Carts;

use App\Models\Cart;
use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        if ($this->input("cart_id")) {
            return auth()->user()->id === Cart::find($this->input("cart_id"))?->user_id;
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
            "cart_id" => "The cart is not acceptable",
        ];
    }

}
