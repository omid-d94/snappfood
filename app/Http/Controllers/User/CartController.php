<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Carts\CartRequest;
use App\Http\Requests\Carts\UpdateCartRequest;
use App\Http\Resources\CartCollection;
use App\Http\Resources\CartPaymentResource;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\CartFood;
use App\Models\Food;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use function auth;
use function response;

class CartController extends Controller
{

    /**
     * returns user's carts
     *
     * @return Application|ResponseFactory|\Illuminate\Http\Response
     */
    public function getCart()
    {
        return response(
            content: new CartCollection(auth()->user()->carts),
            status: Response::HTTP_OK
        );
    }

    /**
     * Adds food to cart
     * by making a new cart
     * or adding more food to exist cart
     * or updating count of food
     * @param CartRequest $request
     * @return Application|ResponseFactory|\Illuminate\Http\Response
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

    /**
     * Updates food cart by cart_id
     *
     * @param UpdateCartRequest $request
     * @param int $cart
     * @return Application|ResponseFactory|\Illuminate\Http\Response
     */
    public function updateCart(UpdateCartRequest $request, int $cart)
    {
        $cart = Cart::find($cart);
        if (!is_null($cart)) {
            $request->validated();
            $request->authorize();
            $result = CartFood::where("cart_id", $cart->id)->update(
                [
                    "food_id" => $request->input("food_id"),
                    "count" => $request->input("count"),
                ]);
            if ($result >= 1) {
                return response(["message" => "Cart updated successfully"], Response::HTTP_NO_CONTENT);
            }
            return response(["message" => "Failed to updating cart!"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response(["message" => "Cart Not Found!"], Response::HTTP_NOT_FOUND);
    }

    /**
     * Deletes a food cart
     *
     * @param int $cart
     * @return Application|ResponseFactory|\Illuminate\Http\Response
     */
    public function deleteCart(int $cart)
    {
        $cart = Cart::find($cart);
        if (!is_null($cart)) {
            Gate::authorize("owner-cart", $cart);
            $cart->delete();
            return response(["message" => "Cart deleted successfully"], Response::HTTP_NO_CONTENT);
        }
        return response(["message" => "Cart Not Found!"], Response::HTTP_NOT_FOUND);
    }

    /**
     * Shows cart information
     *
     * @param int $cart
     * @return Application|ResponseFactory|\Illuminate\Http\Response|void
     */
    public function showCart(int $cart)
    {
        $cart = Cart::find($cart);
        if (!is_null($cart)) {
            Gate::authorize("owner-cart", $cart);
            return response(CartResource::make($cart), Response::HTTP_OK);
        }
        return response(["message" => "Cart Not Found!"], Response::HTTP_NOT_FOUND);
    }

    /**
     * Cart payment
     *
     * @param int $cart
     * @return Application|ResponseFactory|\Illuminate\Http\Response
     */
    public function payForCart(int $cart)
    {
        $cart = Cart::find($cart);
        if (!is_null($cart)) {
            Gate::authorize("owner-cart", $cart);
            return response(CartPaymentResource::make($cart), Response::HTTP_OK);
        }
        return response(["message" => "Cart Not Found!"], Response::HTTP_NOT_FOUND);
    }


}
