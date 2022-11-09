<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\FoodCategoryCollection;
use App\Http\Resources\RestaurantCollection;
use App\Http\Resources\RestaurantResource;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
            $restaurants = Restaurant::type($request->query("type"))
                ->isOpen($request->query("is_open"))
                ->scoreGreaterThan($request->query("score_gt"))
                ->get();
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
     * Get foods of restaurant
     *
     * @param Restaurant $restaurant
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function getFoods(Restaurant $restaurant)
    {
        $foods = $restaurant->foods;
        return response(new FoodCategoryCollection($foods), 200);
    }
}
