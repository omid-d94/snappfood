<?php

namespace App\Http\Requests\Banners;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class BannerStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
            "title" => ["bail", "required", "string", "between:3,255", "unique:banners,title"],
            "image" => ["bail", "required", "image", "mimes:jpg,jpeg,png,svg,gif", "filled", "min:1", "max:3072",
                "dimensions:min_width=500,max_height=500,max_width=3000,max_height=3000"]
        ];
    }

    public function imagePath(): string
    {
        return Storage::disk("public")
            ->put("images/banners", $this->file("image"));
    }
}
