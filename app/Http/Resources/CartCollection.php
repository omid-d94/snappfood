<?php

namespace App\Http\Resources;

use App\Models\CartFood;
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
                    "foods" => collect($cart->foods)->map(function ($food) use ($cart) {
                        return [
                            "id" => $food->id,
                            "title" => $food->title,
                            "count" => CartFood::select("count")
                                ->where("food_id", $food->id)
                                ->where("cart_id", $cart->id)
                                ->first()?->count,
                            "price" => $food->price,
                        ];
                    }),
                    "create_at" => $cart->created_at,
                    "updated_at" => $cart->updated_at
                ];
            })
        ];
    }
}


//CartFoodResource::collection($cart->foods,$cart->id),
