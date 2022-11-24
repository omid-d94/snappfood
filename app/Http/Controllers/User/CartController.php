<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Seller\OrderController;
use App\Http\Requests\Carts\CartRequest;
use App\Http\Requests\Carts\UpdateCartRequest;
use App\Http\Resources\CartCollection;
use App\Http\Resources\CartPaymentResource;
use App\Http\Resources\CartResource;
use App\Jobs\SuccessPaymentJob;
use App\Models\Cart;
use App\Models\CartFood;
use App\Models\Food;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
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
            $result = CartFood::where("cart_id", $cart->id)
                ->where("food_id", $request->input("food_id"))
                ->update(["count" => $request->input("count")]);
            if ($result >= 1) {
                return response(["message" => "Cart updated successfully"], Response::HTTP_NO_CONTENT);
            }
            return response(["message" => "Failed to updating cart!"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response(["message" => "Cart Not Found!"], Response::HTTP_NOT_FOUND);
    }

    /**
     * Deletes the food cart
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
     * @return Application|\Illuminate\Http\Response|ResponseFactory
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
     * @throws Exception
     */
    public function payForCart(int $cart)
    {
        $cart = Cart::find($cart);
        if (!is_null($cart)) {
            Gate::authorize("owner-cart", $cart);

            $trackingCode = $this->trackingCode();

            $order = OrderController::store($cart, $trackingCode);

            $this->dispatch(new SuccessPaymentJob(User::find(auth()->user()->id), $order));
            $cart->delete();

            return response(new CartPaymentResource($order), Response::HTTP_OK);
        }
        return response(["message" => "Cart Not Found!"], Response::HTTP_NOT_FOUND);
    }

    /**
     * Creator's Tracking Code
     *
     * @return string
     */
    public function trackingCode(): string
    {
        return Str::random(10);
    }

    /**
     * Delete the food from cart
     *
     * @param int $cart_id
     * @param int $food
     * @return Application|ResponseFactory|\Illuminate\Http\Response
     */
    public function deleteFood(int $cart_id, int $food)
    {
        $cart = Cart::find($cart_id);
        if (!is_null($cart)) {
            Gate::authorize("owner-cart", $cart);
            $result = $cart->foods()->detach($food);

            if ($result == 1) {
                return response("", Response::HTTP_NO_CONTENT);
            }
            return response(["message" => "The food not found in your cart"],
                Response::HTTP_NOT_FOUND);
        }
        return response(["message" => "Cart Not Found!"], Response::HTTP_NOT_FOUND);
    }
}
