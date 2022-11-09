<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "title" => $this->resource->title,
            "type" => $this->resource->restaurantCategory->name,
            "address" => [
                "address" => $this->address,
                "latitude" => $this->latitude,
                "longitude" => $this->longitude,
            ],
            "is_open" => $this->is_open,
            "score" => $this->score,
            "image" => $this->logo,
            "comment_count" => "THERE ARE NO COMMENTS!",
            "schedule" => new WorkingTimesCollection($this->resource->workingTimes),
        ];
    }
}
