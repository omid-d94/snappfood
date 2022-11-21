<?php

namespace App\Http\Resources;

use App\Models\Cart;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class CartPaymentResource extends JsonResource
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
            "message" => "payment successful",
            "tracking code" => Str::random(8),
            "total payment" => Cart::paymentCart($this->resource)
        ];
    }
}
