<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AddressCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return collect($this->collection)->map(function ($address) {
            return [
                "id" => $address->id,
                "title" => $address->title,
                "address" => $address->address,
                "latitude" => $address->latitude,
                "longitude" => $address->longitude,
            ];
        })->toArray();
    }
}
