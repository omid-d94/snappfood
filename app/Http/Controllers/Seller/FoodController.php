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
        $restaurant = auth("seller")->user()->restaurants->first();
        $foods = Food::where("restaurant_id", $restaurant?->id)->get();
//        dd($foods);
        return view("foods.index", compact("foods"));
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

        //save image to public storage and add image_path to food's table
        $validated["image_path"] = Storage::disk('public')->put('images/foods', $request->file("image_path"));

        $validated["restaurant_id"] = auth("seller")->user()->restaurants->firstOrFail()->id;
        $validated["food_category"] = FoodCategory::where("title", $request->type)->firstOrFail()->id;
        $food = Food::create($validated);

        return redirect("/seller/foods")
            ->with("success", "Congradulation!☺ {$food->title} Has Been Created Successfully");

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Food $food
     * @return \Illuminate\Http\Response
     */
    public function show(Food $food)
    {
        $category = $food->foodCategory;
        return view('foods.show', compact("food", "category"));
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

        if ($request->file("image_path") !== null) {
            Storage::disk('public')->delete($oldPath);
            $imagePath = Storage::disk('public')->put('images/foods', $request->file("image_path"));
        }

//        $validated["food_category"] = $food->foodCategory->id;
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
