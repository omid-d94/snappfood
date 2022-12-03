<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\RestaurantCollection;
use App\Http\Resources\RestaurantResource;
use App\Models\Address;
use App\Models\Restaurant;

//use Illuminate\Http\Client\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;


class NearestRestaurantController extends Controller
{
    /**
     * Find the nearest restaurants
     *
     * using eloquent approach, make sure to replace the "Restaurant" with your actual model name
     * replace 6371000 with 6371 for kilometer and 3956 for miles
     * @param $radius
     * @return Application|ResponseFactory|\Illuminate\Http\Response
     */
    public function findNearestRestaurants($radius = 10000000)
    {

        $address = $this->getUserAddress();
        $restaurants = Restaurant::select(["*"])->selectRaw("
                           ( 6371000 * acos( cos( radians(?) ) *
                           cos( radians( latitude ) )
                           * cos( radians( longitude ) - radians(?)
                           ) + sin( radians(?) ) *
                           sin( radians( latitude ) ) )
                         ) AS distance", [$address->latitude, $address->longitude, $address->latitude])
            ->where('is_open', true)
            ->where('status', true)
            ->having("distance", "<", $radius)
            ->orderBy("distance", 'asc')
            ->offset(0)
            ->limit(20)
            ->get();

        return (count($restaurants) < 1)
            ? response(["message" => "NO RESTAURANT NEAR YOU WAS FOUND!"], Response::HTTP_NOT_FOUND)
            : response(new RestaurantCollection($restaurants), Response::HTTP_OK);

    }


    /**
     * Get Default of user's address
     * @return false|mixed
     */
    public function getUserAddress()
    {
        $userAddresses = auth()->user()->addresses;
        if (count($userAddresses) >= 1) {
            foreach ($userAddresses as $address) {
                if ($address->default) {
                    return $address;
                }
            }
            return $userAddresses->first();
        }
        return false;
    }



    /*
     selectRaw("ST_Distance_Sphere(
                    Point($userAddress->latitude,$userAddress->longitude),
                    Point(latitude,longitude)
                ) / ? as distance", [1000])
     */


    /*
    public function getRestaurantsAddress()
    {
        $restaurantAddresses = Restaurant::select("latitude", "longitude")
            ->where("status", true)->where("is_open", true)->get();
        if (count($restaurantAddresses) >= 1) {
            return $restaurantAddresses;
        }
        return false;
    }

    public function checkDistance($restaurant, $user)
    {
        return Http::withHeaders([
            "Api-key" => Address::API_KEY,
        ])->get(
            url: Address::DISTANCE_MATRIX_URL,
            query: [Address::TYPE => Address::VEHICLE_TYPE,
                Address::ORIGINS => $user->latitude . "," . $user->longitude,
                Address::DESTINATIONS => $restaurant->latitude . "," . $restaurant->longitude]
        );
    }

    public function findNearestRestaurant()
    {
        $userAddress = $this->getUserAddress();
//        $restaurantsAddress = $this->getRestaurantsAddress();
        if (!$userAddress)
            return response(
                content: ["message" => "NO ADDRESS FOUND"],
                status: Response::HTTP_NOT_FOUND);

        $restaurant = Restaurant::whereRaw("ST_Distance_Sphere(
                    Point($userAddress->latitude,$userAddress->longitude),
                    Point(latitude,longitude)
                 ) > ? ", 10000)->first();
        return $restaurant;
        return response(
            content: [
                "message" => "The nearest restaurant was found",
                "restaurant" => RestaurantResource::make($restaurant)
            ], status: Response::HTTP_OK);
    }

*/
}
