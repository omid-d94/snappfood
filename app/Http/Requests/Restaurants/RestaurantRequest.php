<?php

namespace App\Http\Requests\Restaurants;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class RestaurantRequest extends FormRequest
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
            "title" => ["required", "string", "min:3", "max:150"],
            "address" => ["required", "string", "min:3", "max:500"],
//            "longitude" => ["required", "string", "min:3", "max:20"],
//            "latitude" => ["required", "string", "min:3", "max:20"],
            "logo" => ["mimes:jpg,gif,png,svg,jpeg", "max:3072"],
            "type" => ["required"],
            "phone" => ["required", "string", "max:15"],
            "account" => ["required", "alpha_num", "between:10,15 "],
            "send_cost" => ["alpha_num"],
        ];
    }

}
