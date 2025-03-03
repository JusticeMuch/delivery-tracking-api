<?php

namespace App\Http\Controllers;

use App\Http\Resources\Address as AddressResource;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $addressQuery = Address::query();

        if ($user->client){
            $addressQuery->where("client_id", $user->client->id);
        }

        return AddressResource::collection($addressQuery->paginate(20));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $validatedRequest = $request->validate([
            "street_address_1" => "required|string",
            "street_address_2" => "string",
            "suburb" => "required|string",
            "post_code" => "required|string",
            "city" => "string",
            "province" => "string|required",
            "country" => "string"
        ]);

        if ($user->client){
            $validatedRequest["client_id"] = $user->client->id;
        }

        $address = Address::create($validatedRequest);

        return new AddressResource($address);
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        $user = Auth::user();

        if ($user->client && $user->client->id !== $address->client->id){
            return abort(401, "Cannot get this adddress");
        }

        return new AddressResource($address);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Address $address)
    {
        $user = Auth::user();

        if ($user->client && $user->client->id !== $address->client->id){
            return abort(401, "Cannot update this adddress");
        }

        $validatedRequest = $request->validate([
            "street_address_1" => "string",
            "street_address_2" => "string",
            "suburb" => "string",
            "post_code" => "string",
            "city" => "string",
            "province" => "string",
            "country" => "string"
        ]);

        $address->update($validatedRequest);

        return new AddressResource($address);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        $user = Auth::user();

        if ($user->client && $user->client->id !== $address->client->id){
            return abort(401, "Cannot delete this adddress");
        }

        $address->delete();
        return response([
            "message" => "address has been deleted successfully"
        ]);
    }
}
