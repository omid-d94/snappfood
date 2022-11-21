<?php

namespace App\Http\Resources;

use App\Models\CartFood;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{

//    /**
//     * Indicates if the resource's collection keys should be preserved.
//     *
//     * @var bool
//     */
//    public $preserveKeys = true;

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "carts" => [
                "id" => $this->resource->id,
                "restaurant" => [
                    "title" => $this->resource->restaurant->title,
                    "image" => $this->resource->restaurant->logo,
                ],
                "foods" => collect($this->resource->foods)->map(function ($food) {
                    return [
                        "id" => $food->id,
                        "title" => $food->title,
                        "count" => CartFood::select("count")
                            ->where("food_id", $food->id)
                            ->where("cart_id", $this->resource->id)
                            ->first()?->count,
                        "price" => $food->price,
                    ];
                }),
                "create_at" => $this->resource->created_at,
                "updated_at" => $this->resource->updated_at,
            ],
        ];
    }
}
