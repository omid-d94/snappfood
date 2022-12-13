<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class AddressUpdateRequest extends FormRequest
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
            "title" => ["string", "min:1", "max:100"],
            "latitude" => ["numeric", "between:0,600"],
            "longitude" => ["numeric", "between:0,600"],
            "address" => ["string", "min:1", "max:300"],
        ];
    }
}
