<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\Restaurants\RestaurantRequest;
use App\Models\Restaurant;

//use Illuminate\Http\Request;
use App\Models\RestaurantCategory;
use App\Models\WorkingTime;
use Doctrine\Inflector\WordInflector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::all()->where("seller_id", Auth::guard('seller')->user()->id);

        return view('restaurants.index', compact("restaurants"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = RestaurantCategory::all();
        return view("restaurants.profile", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Restaurants\RestaurantRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RestaurantRequest $request)
    {
        $validated = $request->validated();

        $validated["logo"] = Storage::disk('public')->put('images/restaurants', $request->file("logo"));

        $validated["seller_id"] = auth("seller")->user()->id;
        $restaurant = Restaurant::create($validated);
        foreach ($request?->day as $day => $time) {
            WorkingTime::create([
                'day' => $day,
                'start' => $time[0],
                'end' => $time[1],
                'restaurant_id' => $restaurant->id,
            ]);
        }

        return redirect('/seller/restaurants')
            ->with("success", "Congradulation!☺ {$restaurant->title} Has Been Created Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Restaurant $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        return view('restaurants.show', $restaurant->firstOrFail());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Restaurant $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        $categories = RestaurantCategory::all();
        $workingTimes = $restaurant->workingTimes;
        return view('restaurants.edit',
            compact("restaurant", "categories", "workingTimes"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Restaurants\RestaurantRequest $request
     * @param \App\Models\Restaurant $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(RestaurantRequest $request, Restaurant $restaurant)
    {

        $validated = $request->validated();

        $oldPath = $restaurant->logo;
        if ($request->file("logo") !== null) {
            Storage::disk('public')->delete($oldPath);
            $imagePath = Storage::disk('public')->put('images/restaurants', $request->file("logo"));
        }

        foreach ($request->day as $day => $time) {
            $restaurant->workingTimes()->where("day", $day)->update([
                'start' => $time[0],
                'end' => $time[1],
            ]);
        }
        $validated["is_open"] = $request->input("is_open");

        $validated["food_category"] = $request->type;
        $validated['logo'] = $imagePath ?? $oldPath;
        $restaurant->update($validated);

        return redirect("/seller/restaurants")
            ->with("success", "Congradulation!☺ {$restaurant->title} Has Been Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Restaurant $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        Storage::disk('public')->delete($restaurant->logo);
        $restaurant->delete();

        return redirect("/seller/restaurants")
            ->with("success", "Congradulation!☺ {$restaurant->title} Has Been Deleted Successfully");
    }

//    public function showSetting()
//    {
//        $restaurant = Restaurant::all()->where("seller_id", Auth::guard('seller')->id())->firstOrFail();
//        $isOpen = $restaurant->is_open;
//        $workingTimes = $restaurant->workingTimes;
//        return view("restaurants.setting", compact("workingTimes", "isOpen"));
//    }
//
//    public function changeSetting(Request $request, Restaurant $restaurant)
//    {
//        Restaurant::create(
//            [
//                "is_open" => $request->input("is_open")
//            ]
//        );
//
//        foreach ($request->day as $day => $time) {
//            $working_times_id[] = WorkingTime::create([
//                'day' => $day,
//                'start' => $time[0],
//                'end' => $time[1],
//            ])->id;
//        }
//        $restaurant->workingTimes()->sync($working_times_id);
//        return redirect()->route("seller.restaurants.index")
//            ->with("success", "RESTAURANT SETTING HAS BEEN UPDATED!☺");
//    }
}
