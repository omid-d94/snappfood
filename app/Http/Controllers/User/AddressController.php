<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\AddressCollection;
use App\Http\Resources\AddressResource;
use App\Models\Address;

//use Illuminate\Http\Request;
use App\Http\Requests\User\AddressCreateRequest as CreateRequest;
use App\Http\Requests\User\AddressUpdateRequest as UpdateRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addresses = auth()->user()->addresses->all();
        return response(new AddressCollection($addresses), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\User\AddressCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $validated = $request->validated();
        $address = Address::create($validated);
        $address->users()->attach(auth("sanctum")->user()->id);
        return response(["message" => "Address added successfully"], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $address
     * @return \Illuminate\Http\Response
     */
    public function show($address)
    {
        $address = Address::where("id", $address)->first();
        if ($address)
            return response(new AddressResource($address));
        return response(["message" => "Address Not Found!"], 404);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Address $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\User\AddressUpdateRequest $request
     * @param \App\Models\Address $address
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Address $address)
    {
        $validated = $request->validated();
        if ($address->exists) {
            $address->update($validated);
            return response(["message" => "Address updated successfully"], 201);
        }
        return response(["message" => "Address Not Found!"], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Address $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        if ($address->exists) {
            $address->delete();
            return response(["message" => "Address deleted successfully"]);
        }
        return response(["message" => "Address Not Found!"], 404);
    }


    public function setDefaultAddress(Address $address)
    {
        $addresses = auth("sanctum")->user()->addresses;
        collect($addresses)->map(fn($address) => $address->update(["default" => false]));
        if ($address->exists) {
            $address->update(["default" => true]);
            return response(["message" => "Current address updated successfully"], 201);
        }
        return response(["message" => "fail to set default address"], 405);
    }
}