<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            "author" => $this->resource->order->user->name,
            "foods" => OrderFoodResource::collection($this->resource->order->foods),
            "created_at" => $this->resource->created_at->diffForHumans(),//format('M.d H:i'),
            "score" => $this->resource->score,
            "content" => $this->resource->message,
            "answer" => $this->resource->answer,
        ];
    }
}
