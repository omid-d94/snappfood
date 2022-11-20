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
                "id" => $this->id,
                "restaurant" => [
                    "title" => $this->resource->restaurant->title,
                    "image" => $this->resource->restaurant->logo,
                ],
                "foods" => CartFoodResource::collection($this->foods, $this->id),
                "create_at" => $this->created_at,
                "updated_at" => $this->updated_at,
            ],
        ];
    }
}
