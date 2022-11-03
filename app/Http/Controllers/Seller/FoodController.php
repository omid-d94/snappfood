<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\Foods\FoodRequest;
use App\Models\Food;
use App\Models\FoodCategory;

//use Illuminate\Http\Request;

use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $restaurants = auth("seller")->user()->restaurants;

//        foreach ($restaurants as $restaurant) {
//            $foods[] = $restaurant->foods;
//        }

//        $foods = Food::all();

        return view("foods.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = FoodCategory::all();
        return view("foods.create", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Foods\FoodRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(FoodRequest $request)
    {
        $validated = $request->validated();
        $validated["image_path"] = Storage::disk('public')->put('images/foods', $request->file("image"));

        $validated["restaurant_id"] = Restaurant::where("seller_id", auth("seller")->user())->firstOrFail()->id;

        $validated["food_category"] = FoodCategory::where("title", $request->type)->firstOrFail()->id;
        $food = Food::create($validated);

        return redirect("/seller/foods")
            ->with("success", "Congradulation!☺ {$food->title} Has Been Created Successfully");;

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Food $food
     * @return \Illuminate\Http\Response
     */
    public function show(Food $food)
    {
        return view('foods.show', $food->firstOrFail());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Food $food
     * @return \Illuminate\Http\Response
     */
    public function edit(Food $food)
    {
        $categories = FoodCategory::all();

        return view('foods.edit',
            compact("food", "categories"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Foods\FoodRequest $request
     * @param \App\Models\Food $food
     * @return \Illuminate\Http\Response
     */
    public function update(FoodRequest $request, Food $food)
    {
        $validated = $request->validated();

        $oldPath = $food->image_path;
        if ($request->file("image") !== null) {
            Storage::disk('public')->delete($oldPath);
            $imagePath = Storage::disk('public')->put('images/foods', $request->file("image"));
        }
        $validated["food_category"] = $food->foodCategory->id;
        $validated['image_path'] = $imagePath ?? $oldPath;
        $food->update($validated);

        return redirect("/seller/foods")
            ->with("success", "Congradulation!☺ {$food->title} Has Been Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Food $food
     * @return \Illuminate\Http\Response
     */
    public function destroy(Food $food)
    {
        Storage::disk('public')->delete($food->image_path);
        $food->delete();

        return redirect("/seller/foods")
            ->with("success", "Congradulation!☺ {$food->title} Has Been Deleted Successfully");
    }
}
