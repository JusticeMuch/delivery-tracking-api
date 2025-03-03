<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverController extends Controller
{
    /**
     * Select Delivery Region
     */
    public function updateDeliveryRegion(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            "delivery_region_id" => "required|numeric"
        ]);

        $user->client->update([
            "delivery_region_id" => $request->delivery_region_id
        ]);

        return response([
            "message" => "Delivery Region Updated"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function deliveryScheduleByDate(Request $request)
    {
        $request->validate([
            "scheduled_delivery_date" => "required|date"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Driver $driver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Driver $driver)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Driver $driver)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Driver $driver)
    {
        //
    }
}
