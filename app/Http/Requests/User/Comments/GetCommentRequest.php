<?php

namespace App\Http\Requests\User\Comments;

use Illuminate\Foundation\Http\FormRequest;

class GetCommentRequest extends FormRequest
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
            "restaurant_id" => ["numeric", "exists:restaurants,id"],
            "food_id" => ["numeric", "exists:foods,id"],
        ];
    }

    public function messages()
    {
        return [
            "food_id.exists" => ["FOOD NOT FOUND!"],
            "restaurant_id.exists" => ["RESTAURANT NOT FOUND!"],
        ];
    }
}
