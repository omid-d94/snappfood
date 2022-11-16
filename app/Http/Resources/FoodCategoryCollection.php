<?php


namespace App\Http\Resources;

use App\Http\Resources\FoodResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class FoodCategoryCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "categories" => collect($this->collection)
                ->map(function ($foodCategory) {
                    return [
                        "id" => $foodCategory->id,
                        "title" => $foodCategory->title,
                        "foods" => FoodResource::collection($foodCategory->foods),
                    ];
                })
        ];
    }
}



