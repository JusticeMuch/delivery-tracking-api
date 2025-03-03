<?php

namespace App\Http\Controllers;

use App\Http\Resources\DeliverySchedule as DeliveryScheduleResource;
use App\Models\DeliverySchedule;
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
     * Get the delivery scheduled for that driver.
     */
    public function deliverySchedules(Request $request)
    {
        $driverId = Auth::user()->driver->id;
        $request->validate([
            "date_from" => "date",
            "date_to" => "date"
        ]);

        $query = DeliverySchedule::query()->where("driver_id", $driverId);

        if (isset($request->date_from)){
            $query->where("delivery_date", ">=",  $request->date_from);
        }

        if (isset($request->date_to)){
            $query->where("delivery_date", "<=",  $request->date_to);
        }

        return DeliveryScheduleResource::collection($query->get());
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
