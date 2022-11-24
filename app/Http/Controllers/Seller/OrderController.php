<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Jobs\OrderStatusJob;
use App\Models\Cart;
use App\Models\CartFood;
use App\Models\FoodOrder;
use App\Models\Order;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    /**
     * Gets all orders related to restaurant
     *
     * @return Application|Factory|View
     */
    public function getOrders()
    {
        $restaurant = auth("seller")->user()->restaurants->first();
        $orders = Order::where("restaurant_id", $restaurant->id)
            ->paginate($perPage = 10, $columns = ["*"], $pageName = "order-page");
        return view("seller.dashboard", compact("orders"));
    }

    /**
     * Gets Archived Orders
     *
     * @return Application|Factory|View
     */
    public function getArchivedOrders()
    {
        $restaurant = auth("seller")->user()->restaurants->first();
        $orders = Order::where("restaurant_id", $restaurant->id)
            ->where("status", Order::DELIVERED)->withTrashed()
            ->paginate($perPage = 10, $columns = ["*"], $pageName = "order-page");
        return view("seller.dashboard", compact("orders"));
    }

    /**
     * Storing the cart as an order
     *
     * @param Cart $cart
     * @param string $trackingCode
     * @return Order
     * @throws Exception
     */
    public static function store(Cart $cart, string $trackingCode): Order
    {
        try {
            $order = Order::create(
                [
                    "status" => Order::PENDING,
                    "user_id" => $cart->user_id,
                    "restaurant_id" => $cart->restaurant_id,
                    "total" => Cart::paymentCart($cart),
                    "tracking_code" => $trackingCode,
                ]
            );
            if ($order) {
                dispatch(new OrderStatusJob(User::find($order->user_id), $order));
            }
            $cartFood = CartFood::where("cart_id", $cart->id)->get();
            if ($cartFood) {
                foreach ($cartFood as $item) {
                    FoodOrder::create(
                        [
                            "count" => $item->count,
                            "food_id" => $item->food_id,
                            "order_id" => $order->id,
                        ]
                    );
                }
            }
            return $order;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * Shows a specific order
     *
     * @param int $order_id
     * @return Application|Factory|View
     */
    public function showOrder(int $order_id)
    {
        $order = Order::where("id", $order_id)->withTrashed()->first();
        return view("orders.show", compact("order"));
    }


    /**
     * Updating order status
     *
     * @param Request $request
     * @param Order $order
     * @return RedirectResponse
     */
    public function updateStatus(Request $request, Order $order)
    {
        $result = $order->update([
            "status" => $request->input("status")
        ]);
        dispatch(new OrderStatusJob(User::find($order->user_id), $order))->beforeCommit();
        $status = Order::where("id", $order->id)->first()->status;

        if ($result) {
            if ($status == "DELIVERED")
                $this->destroy($order);
            return redirect()
                ->route("seller.dashboard", "", Response::HTTP_CREATED)
                ->with("success", "Order Status changed to $status for order $order->id");
        }
        return redirect()
            ->route("seller.dashboard", "", Response::HTTP_INTERNAL_SERVER_ERROR)
            ->with("fail", "failed to updating order status for order $order->id");
    }

    /**
     * Soft delete an order
     * @param Order $order
     * @return void
     */
    public function destroy(Order $order)
    {
        $order->delete();
    }
}
