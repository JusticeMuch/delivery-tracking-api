<?php

namespace App\Http\Controllers;

use App\Http\Resources\Delivery as DeliveryResource;
use App\Http\Resources\DeliveryPackage as DeliveryPackageResource;
use App\Models\Client;
use App\Models\Delivery;
use App\Models\DeliveryPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{

    /**
     * Add Delivery Package
     */
    public function addDelivery(Request $request)
    {
        $clientId = Auth::user()->client->id;

        $validatedRequest = $request->validate([
            "address_id" => "required|numeric",
            "scheduled_date" => "required|date",
            "special_delivery_instructions" => "string",
            "packages" => "required|array",
            "packages.*.package_name" => "required|string",
            "packages.*.package_description" => "string",
            "packages.*.weight" => "required|numeric",
            "packages.*.height" => "required|numeric",
            "packages.*.length" => "required|numeric",
            "packages.*.width" => "required|numeric"
        ]);

        $delivery = Delivery::createDeliveryFromRequest($validatedRequest, $clientId);

        return new DeliveryResource($delivery);
    }

     /**
     * Update Delivery
     */
    public function updateDelivery(Request $request, Delivery $delivery)
    {
        $clientId = Auth::user()->client->id;

        $validatedRequest = $request->validate([
            "address_id" => "numeric",
            "scheduled_date" => "date",
            "special_delivery_instructions" => "string",
        ]);

        $delivery = $delivery->update($validatedRequest, $clientId);

        return new DeliveryResource($delivery);
    }

     /**
     * Update Delivery
     */
    public function updateDeliveryPackage(Request $request, DeliveryPackage $deliveryPackage)
    {
        $clientId = Auth::user()->client->id;

        $validatedRequest = $request->validate([
            "package_name" => "string",
            "package_description" => "string",
            "weight" => "numeric",
            "height" => "numeric",
            "length" => "numeric",
            "width" => "numeric"
        ]);

        $deliveryPackage->update($validatedRequest, $clientId);

        return new DeliveryPackageResource($deliveryPackage);
    }

     /**
     * Update Delivery
     */
    public function getDeliveries(Request $request, DeliveryPackage $deliveryPackage)
    {
        $clientId = Auth::user()->client->id;

        return DeliveryResource::collection(Delivery::query()->where("client_id", $clientId)->paginate(20));
    }


}
