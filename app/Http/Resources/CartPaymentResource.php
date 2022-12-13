<?php

namespace App\Http\Resources;

use App\Models\Cart;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class CartPaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "message" => "payment successful",
            "tracking code" => $this->resource->tracking_code,
            "total payment" => $this->resource->total,
        ];
    }
}
