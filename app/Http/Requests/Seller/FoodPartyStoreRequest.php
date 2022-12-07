<?php

namespace App\Http\Requests\Seller;

use Illuminate\Foundation\Http\FormRequest;

class FoodPartyStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "foods" => ["required", "numeric", "exists:foods,id"],
            "discount" => ["required", "numeric", "exists:discounts,id"],
            "count" => ["required", "numeric", "between:1,5"],
        ];
    }
}
