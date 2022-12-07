<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\FoodPartyStoreRequest;
use App\Models\Discount;
use App\Models\FoodFoodParty;
use App\Models\FoodParty;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class FoodPartyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $foods = $this->getRestaurant()->foods()->with("foodParties")->get();
        return view("foods.foodParties.index", compact("foods"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $discounts = Discount::all();
        $foods = $this->getRestaurant()->foods;
        return view("foods.foodParties.create", compact("foods", "discounts"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param FoodPartyStoreRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(FoodPartyStoreRequest $request): Redirector|Application|RedirectResponse
    {
        $request->validated();
        $foodParty = FoodParty::all()->first();
        if (!is_null($foodParty)) {
            FoodFoodParty::create([
                "food_party_id" => $foodParty->id,
                "food_id" => $request->foods,
                "discount_id" => $request->discount,
                "count" => $request->input("count"),
            ]);
            return redirect()->route("food-party.index")
                ->with("success", "The food add to food party successfully");
        }
        return redirect()->route("food-party.index")
            ->with("fail", "Currently, it is not possible to add food to the food party");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Get foods of restaurant
     * @return mixed
     */
    public function getRestaurant()
    {
        return auth("seller")->user()->restaurants->first();
    }
}
