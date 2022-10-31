<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRestaurantCategoryRequest as StoreRequest;
use App\Http\Requests\UpdateRestaurantCategory as UpdateRequest;
use App\Models\RestaurantCategory;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RestaurantController extends Controller
{
    /**
     * Only Admin Can Access To These Actions
     */
    public function __construct()
    {
        $this->middleware(['auth', 'isAdmin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = RestaurantCategory::all();
        return view("categories.restaurants.index", compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.restaurants.create');
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
//        $image_path = $request->file('image')->storePublicly("images/categories");
//        dd($image_path);
        $imagePath = Storage::disk('public')->put('images/categories', $request->file("image"));

        RestaurantCategory::create([
            "name" => $request->input("name"),
            "slug" => Str::slug($request->name),
            "image_path" => $imagePath,
        ]);
        return redirect('/restaurants')
            ->with("success", "New Category Has Been Added Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(int $id)
    {
        return view("categories.restaurants.show", ["category" => RestaurantCategory::where("id", $id)->firstOrFail()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = RestaurantCategory::where("id", $id)->firstOrFail();
        return view("categories.restaurants.edit", compact("category"));
    }

    /**
     * Update the specified resource in storage.
     * First, it is checked that if the photo is to be updated,
     * The previous photo will be deleted from the memory and the new photo will replace it,
     * otherwise no action will be taken
     *
     * @param UpdateRequest $request
     * @param $id
     * @return void
     */
    public function update(UpdateRequest $request, $id)
    {
        $request->validated();

        $oldPath = RestaurantCategory::where("id", $id)->firstOrFail()->image_path;

        if ($request->file("image") !== null) {
            Storage::disk('public')->delete($oldPath);
            $imagePath = Storage::disk('public')->put('images/categories', $request->file("image"));
        }
        RestaurantCategory::where("id", $id)
            ->update([
                "name" => $request->input("name"),
                "slug" => Str::slug($request->input("name")),
                "image_path" => $imagePath ?? $oldPath,
            ]);
        return redirect("/restaurants")
            ->with("success", "New Category Has Been Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $category = RestaurantCategory::where("id", $id)->firstOrFail();
        $category->delete();
        Storage::delete($category->image_path);
        return redirect("/restaurants")
            ->with("success", "{$category->name} Category Has Been Deleted Successfully");
    }
}
