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
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\User\AddressCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $validated = $request->validated();
        $address = Address::create($validated);
        $address->users()->attach(auth()->user()->id);
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
        $address = auth()->user()->addresses->where("id", $address)->first();
        if ($address)
            return response(new AddressResource($address));
        return response(["message" => "Address Not Found!"], 404);

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

        if ($address->exists && auth()->user()->addresses->contains($address)) {
            $address->update($validated);
            return response(["message" => "Address updated successfully"], 201);
        }
        return response(["message" => "Address Not Found!"], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $address = Address::where("id", $id)->first();
        if ($address?->exists && auth()->user()->addresses->contains($address)) {
            $address->delete();
            return response(["message" => "Address deleted successfully"]);
        }
        return response(["message" => "Address Not Found!"], 404);
    }


    public function setDefaultAddress(Address $address)
    {
        $addresses = auth()->user()->addresses;
        if ($addresses->contains($address)) {
            collect($addresses)->map(function ($userAddress) {
                return $userAddress->update(["default" => false]);
            });

            $address->update(["default" => true]);
            return response(["message" => "Current address updated successfully"], 201);
        }
        return response(["message" => "Fail to set default address! Address not found."], 405);
    }
}
