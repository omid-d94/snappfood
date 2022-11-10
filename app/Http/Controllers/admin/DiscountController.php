<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Discount;

//use Illuminate\Http\Request;
use App\Http\Requests\Admin\CreateDiscountRequest as CreateRequest;
use App\Http\Requests\Admin\UpdateDiscountRequest as UpdateRequest;
use Illuminate\Support\Str;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discounts = Discount::all();
        return view("admin.discounts.index", compact("discounts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.discounts.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Admin\CreateDiscountRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $validated = $request->validated();
        $validated["factor"] = 1 - ($validated["percent"] / 100);
        $validated["code"] = Str::random(6);
        $discount = Discount::create($validated);
        return redirect()->route("discounts.index")
            ->with("success", "{$discount->title} discount has been created successfully! ☺");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Discount $discount
     * @return \Illuminate\Http\Response
     */
    public function show(Discount $discount)
    {
        return view("admin.discounts.show", compact("discount"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Discount $discount
     * @return \Illuminate\Http\Response
     */
    public function edit(Discount $discount)
    {
        return view("admin.discounts.edit", compact("discount"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Admin\UpdateDiscountRequest $request
     * @param \App\Models\Discount $discount
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Discount $discount)
    {
        $validated = $request->validated();
        $validated["factor"] = 1 - ($validated["percent"] / 100);
        $discount->update($validated);

        return redirect("/admin/discounts")
            ->with("success", "{$discount->title} discount has been updated Successfully! ☺");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Discount $discount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discount $discount)
    {
        if ($discount->exists)
            $discount->delete();
        return redirect("/admin/discounts")
            ->with("success", "{$discount->title} discount has been deleted Successfully! ☺");

    }
}
