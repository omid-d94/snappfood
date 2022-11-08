<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class AddressCreateRequest extends FormRequest
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
            "title" => ["required", "string", "min:1", "max:100"],
            "latitude" => ["required", "numeric", "between:0,600"],
            "longitude" => ["required", "numeric", "between:0,600"],
            "address" => ["required", "string", "min:1", "max:300"],
        ];
    }
}
