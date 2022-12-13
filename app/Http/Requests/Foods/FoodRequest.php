<?php

namespace App\Http\Requests\Foods;

use Illuminate\Foundation\Http\FormRequest;

class FoodRequest extends FormRequest
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
            "title" => ["required", "string", "between:2,200"],
            "raw_material" => ["string", "between:0,500"],
            "food_category" => ["required", "exists:food_categories,id"],
            "price" => ["required", "numeric"],
            "discount_id" => [""],
            "image" => ["mimes:jpg,gif,png,svg,jpeg", "max:3072"],
        ];
    }
}
