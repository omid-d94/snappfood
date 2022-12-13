<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\RestaurantCollection;
use App\Http\Resources\RestaurantResource;
use App\Models\Address;
use App\Models\Restaurant;
use Exception;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;
use Throwable;


class NearestRestaurantController extends Controller
{
    /**
     * Find the nearest restaurants that equal less than radius param
     *
     * @param int $radius
     * @return Application|ResponseFactory|\Illuminate\Http\Response
     * @throws Exception
     */
    public function findNearestRestaurants(int $radius = 10000)
    {
        try {
            $address = $this->getUserAddress();

            if ($address !== false) {
                $restaurants = Restaurant::select(["*"])
                    ->selectRaw("ST_Distance_Sphere(
                    Point(latitude,longitude),
                    Point($address->latitude,$address->longitude)
                ) as distance")
                    ->where('is_open', true)
                    ->where('status', true)
                    ->having("distance", "<=", $radius)
                    ->orderBy("distance", 'asc')
                    ->limit(20)
                    ->get();

                return (count($restaurants) < 1)
                    ? response(["message" => "NO RESTAURANT NEAR YOU WAS FOUND!"], Response::HTTP_NOT_FOUND)
                    : response(
                        [
                            "message" => count($restaurants) . " has been founded!",
                            "restaurants" => new RestaurantCollection($restaurants)
                        ],
                        Response::HTTP_OK);
            }
            return response(["message" => "You have no address for yourself. Please add an address"], Response::HTTP_BAD_REQUEST);
        } catch (Throwable $e) {
            throw new Exception(message: $e->getMessage(), code: $e->getCode());
        }
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

    /**
     * Get response from Neshan api to calculate distance
     *
     * @param $restaurants
     * @param $user
     * @return PromiseInterface|\Illuminate\Http\Client\Response
     */
    public function checkTimeDistance($restaurants, $user)
    {
        $destination = $this->prepareDestination($restaurants);
        return Http::withHeaders([
            "Api-key" => Address::API_KEY,
        ])->acceptJson()->accept("*/*")->get(
            url: Address::DISTANCE_MATRIX_URL,
            query: [Address::TYPE => Address::VEHICLE_TYPE,
                Address::ORIGINS => $user->latitude . "," . $user->longitude,
                Address::DESTINATIONS => $destination]
        );
    }

    /**
     * merge location of each restaurant in destinations
     *
     * @param $restaurants
     * @return string
     */
    public function prepareDestination($restaurants)
    {
        return implode(
            separator: "|",
            array: $restaurants->map(function ($restaurant) {
                return $restaurant->latitude . "," . $restaurant->longitude;
            })->toArray()
        );
    }

}
