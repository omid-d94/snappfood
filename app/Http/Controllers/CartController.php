<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartCollection;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\CartFood;
use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Requests\Carts\CartRequest;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{

    /**
     * return user's carts
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function getCart()
    {
        return response(
            content: new CartCollection(auth()->user()->carts),
            status: Response::HTTP_OK
        );
    }

    /**
     * Add food to cart
     *
     * @param CartRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function addToCart(CartRequest $request)
    {
        $request->validated();
        $request->authorize();

        if (!$request->cart_id) {
            $cart = Cart::create(
                [
                    "user_id" => auth()->user()->id,
                    "restaurant_id" => Food::findOrFail($request->food_id)->restaurant_id,
                ]
            );
        }

        CartFood::updateOrCreate(
            [
                "food_id" => $request->food_id,
                "cart_id" => $cart->id ?? $request->cart_id,
            ],
            [
                "count" => $request->count
            ]
        );

        return response(
            content: [
                "message" => "food added to cart successfully",
                "cart_id" => $cart->id ?? $request->cart_id,
            ],
            status: Response::HTTP_CREATED
        );
    }

}
