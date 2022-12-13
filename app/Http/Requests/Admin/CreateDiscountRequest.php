<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateDiscountRequest extends FormRequest
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
            "expired_at" => ["after:" . now()->addHour(), "before:" . now()->addMonths(6)],
            "percent" => ["required", "between:0,100", "numeric"],
        ];
    }
}
