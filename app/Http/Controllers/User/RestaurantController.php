<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\FoodCategoryCollection;
use App\Http\Resources\RestaurantCollection;
use App\Http\Resources\RestaurantResource;
use App\Models\Food;
use App\Models\FoodCategory;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $restaurants = Restaurant::all();

        //filter
        if (count($request->query()) > 0) {

            if ($request->query("type")) {
                $restaurants = Restaurant::type($request->query("type"))->get();
            }

            if ($request->query("score_gt")) {
                $restaurants = Restaurant::scoreGreaterThan($request->query("score_gt"))->get();
            }

            if ($request->query("is_open")) {
                $restaurants = Restaurant::restaurantIsOpen($request->query("is_open"))->get();
            }
        }
        return response(new RestaurantCollection($restaurants), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $restaurant
     * @return Response
     */
    public
    function show(int $restaurant)
    {
        $restaurant = Restaurant::where("id", $restaurant)->first();
        if ($restaurant) {
            return response(new RestaurantResource($restaurant), 200);
        }
        return response(["message" => "Restaurant Not Found!"], 404);
    }

    /**
     * Get foods of a restaurant
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function getFoods(int $id)
    {
        $restaurant = Restaurant::where("id", $id)->first();

        if (!is_null($restaurant)) {
            $foodCategories = $restaurant->foodCategories()
                ->with("foods", function ($query) use ($restaurant) {
                    return $query->where("restaurant_id", $restaurant->id);
                })->get();
            return response(new FoodCategoryCollection($foodCategories), 200);
        }
        return response(["message" => "NOT FOUND!"], 404);
    }
}
