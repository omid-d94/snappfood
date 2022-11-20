<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CartCollection extends ResourceCollection
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
            "carts" => collect($this->collection)->map(function ($cart) {
                return [
                    "id" => $cart->id,
                    "restaurant" => [
                        "title" => $cart->resource->restaurant->title,
                        "image" => $cart->resource->restaurant->logo,
                    ],
                    "foods" => CartFoodResource::collection($cart->foods, $cart->id),
                    "create_at" => $cart->created_at,
                    "updated_at" => $cart->updated_at
                ];
            })
        ];
    }
}
