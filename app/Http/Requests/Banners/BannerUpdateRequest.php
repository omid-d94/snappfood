<?php

namespace App\Http\Requests\Banners;

use App\Models\Banner;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class BannerUpdateRequest extends FormRequest
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
            "title" => ["string", "between:3,255"],
            "image" => ["bail", "image", "mimes:jpg,jpeg,png,svg,gif", "filled", "min:1", "max:3072",
                "dimensions:min_width=500,max_height=500,max_width=3000,max_height=3000"]
        ];
    }

    public function imagePath(Banner $banner)
    {
        $oldPath = $banner->image;
        if ($this->file("image") !== null) {
            Storage::disk('public')->delete($oldPath);
            $imagePath = Storage::disk('public')->put('images/banners', $this->file("image"));
        }
        return $imagePath ?? $oldPath;
    }
}
