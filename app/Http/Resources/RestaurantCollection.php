<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RestaurantCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return collect($this->collection)->map(function ($restaurant) {
            return [
                "id" => $restaurant->id,
                "title" => $restaurant->title,
                "type" => $restaurant->restaurantCategory->name,
                "address" => [
                    "address" => $restaurant->address,
                    "longitude" => $restaurant->longitude,
                    "latitude" => $restaurant->latitude,
                ],
                "score" => $restaurant->score,
                "is_open" => $restaurant->is_open,
                "image" => $restaurant->logo
            ];
        });
    }
}
