<?php

namespace App\Http\Requests\Seller;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use function now;

class FilterChartRequest extends FormRequest
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
            "from" => ["required", "date"],//, "before=" . Carbon::parse($this->input("to"))
            "to" => ["required", "date"],//, "after=" . Carbon::parse($this->input("from"))
        ];
    }
}
