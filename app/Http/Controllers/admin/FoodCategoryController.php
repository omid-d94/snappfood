<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Categories\StoreFoodCategoryRequest as StoreRequest;
use App\Http\Requests\Categories\UpdateFoodCategoryRequest as UpdateRequest;
use App\Models\FoodCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FoodCategoryController extends Controller
{

    /**
     * Only Admin Can Access To These Actions
     */
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $foodCategories = FoodCategory::all();
        return view("categories.foods.index", compact("foodCategories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("categories.foods.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreRequest $request)
    {
        $request->validated();
        $imagePath = Storage::disk('public')->put('images/categories/foods', $request->file("image"));
        $category = FoodCategory::create([
            "title" => $request->input("title"),
            "slug" => Str::slug($request->title),
            "image_path" => $imagePath,
        ]);
        return redirect('/admin/foodCategories')
            ->with("success", "{$category->title} Category Has Been Added Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view(
            view: "categories.foods.show",
            data: ["category" => FoodCategory::where("id", $id)->firstOrFail()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = FoodCategory::where("id", $id)->firstOrFail();
        return view("categories.foods.edit", compact("category"));
    }

    /**
     * Update the specified resource in storage.
     * First, it is checked that if the photo is to be updated,
     * The previous photo will be deleted from the memory and the new photo will replace it,
     * otherwise no action will be taken
     *
     * @param UpdateRequest $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateRequest $request, $id)
    {
        $request->validated();
        $oldPath = FoodCategory::where("id", $id)->firstOrFail()->image_path;
        if ($request->file("image") !== null) {
            Storage::disk('public')->delete($oldPath);
            $imagePath = Storage::disk('public')->put('images/categories/foods', $request->file("image"));
        }
        FoodCategory::where("id", $id)
            ->update([
                "title" => $request->input("title"),
                "slug" => Str::slug($request->input("title")),
                "image_path" => $imagePath ?? $oldPath,
            ]);
        return redirect("/admin/foodCategories")
            ->with("success", "{$request->title} Category Has Been Updated Successfully");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = FoodCategory::where("id", $id)->firstOrFail();
        Storage::disk('public')->delete($category->image_path);
        $category->delete();
        return redirect("/admin/foodCategories")
            ->with("success", "{$category->title} Category Has Been Deleted Successfully");
    }
}
