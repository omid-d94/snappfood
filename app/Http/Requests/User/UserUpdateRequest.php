<?php

namespace App\Http\Requests\User;

use Illuminate\Validation\Rules;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name' => ['string', 'max:255'],
            'email' => ['string', 'email', 'max:255', 'unique:users'],
            'phone' => ["regex:/(\+989)\d{9}/", 'unique:users'],
            'password' => ['confirmed', Rules\Password::defaults()],
        ];
    }
}
