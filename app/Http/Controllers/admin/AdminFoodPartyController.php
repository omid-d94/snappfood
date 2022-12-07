<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FoodPartyManagementRequest as Request;
use App\Models\FoodParty;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class AdminFoodPartyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $foodParties = FoodParty::withTrashed()
            ->paginate($perPage = 10, $columns = ["*"], $pageName = "food-parties");
        return view("foods.foodParties.management.index", compact("foodParties"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view("foods.foodParties.management.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validated();
        $foodParty = FoodParty::create($validated);
        return !$foodParty
            ? redirect()->route("food-party-management.index")
                ->with("fail", "The Food party not created")
            : redirect()->route("food-party-management.index")
                ->with("success", "The Food party has been created successfully");

    }

    /**
     * Display the specified resource.
     *
     * @param FoodParty $foodParty
     * @return Response
     */
    public function show(FoodParty $food_party_management)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param FoodParty $food_party_management
     * @return Application|Factory|View
     */
    public function edit(FoodParty $food_party_management): View|Factory|Application
    {
        return view("foods.foodParties.management.edit", ["foodParty" => $food_party_management]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param FoodParty $food_party_management
     * @return RedirectResponse
     */
    public function update(Request $request, FoodParty $food_party_management): RedirectResponse
    {
        $request->validated();
        $result = $food_party_management->update([
            "start" => $request->input("start"),
            "end" => $request->input("end"),
        ]);
        return $result
            ? redirect()->route("food-party-management.index")
                ->with("success", "The food party has been updated successfully")
            : redirect()->route("food-party-management.index")
                ->with("fail", "The food party not updated");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param FoodParty $food_party_management
     * @return RedirectResponse
     */
    public function destroy(FoodParty $food_party_management): RedirectResponse
    {
        $result = $food_party_management->delete();
        return $result
            ? redirect()->route("food-party-management.index")
                ->with("success", "The food party has been deleted successfully")
            : redirect()->route("food-party-management.index")
                ->with("fail", "The food party not deleted");
    }
}
