<?php

namespace App\Http\Controllers;

use App\Http\Resources\DeliveryRegion as DeliveryRegionResource;
use App\Models\Address;
use App\Models\DeliveryRegion;
use Illuminate\Http\Request;

class DeliveryRegionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return DeliveryRegionResource::collection(DeliveryRegion::paginate(20));
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
        $validatedRequest = $request->validate([
            "name" => "string|required",
            "province" => "string|required",
            "suburb" => "array|required"
        ]);

        $deliveryRegion = DeliveryRegion::create($validatedRequest);

        return new DeliveryRegionResource($deliveryRegion);
    }

    /**
     * Display the specified resource.
     */
    public function show(DeliveryRegion $deliveryRegion)
    {
        return new DeliveryRegionResource($deliveryRegion);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DeliveryRegion $deliveryRegion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DeliveryRegion $deliveryRegion)
    {
        $validatedRequest = $request->validate([
            "name" => "string",
            "province" => "string",
            "suburb" => "array",
        ]);

        $deliveryRegion->update($validatedRequest);

        return new DeliveryRegionResource($deliveryRegion);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeliveryRegion $deliveryRegion)
    {
        //
    }

   /**
     * Gets suburbs from addresses that dont have any delivery regions
     */
    public function getUnassignedSuburbs()
    {
        return response([
            "suburbs" => Address::getSuburbsWithoutDeliveryRegions()
        ]);
    }

     /**
     * Updates the delivery regions of addresses where it can and returns the addresses of those that it cannot
     */
    public function updateAddressesWithoutDeliveryRegions(){
        Address::updateEmptyDeliveryRegions();

        return response([
            "addresses" => Address::getAddressesWhereDeliveryRegionIsNull()
        ]);
    }


}
