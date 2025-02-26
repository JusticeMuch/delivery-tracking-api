<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('delivery_statuses', function (Blueprint $table) {
            $table->id();
            $table->string("status", 32);
            $table->string("description");
            $table->timestamps();
        });

        DB::table("delivery_statuses")->insert([
            [
                "id" => 1,
                "status" => "delivered",
                "description" => "Delivery carried out in full , every package delivered",
            ],
            [
                "id" => 2,
                "status" => "partially_delivered",
                "description" => "Some of the packages were delivered , but not all"
            ],
            [
                "id" => 3,
                "status" => "rescheduled",
                "description" => "Delivery is rescheduled for another day (normally next business day)"
            ],
            [
                "id" => 4,
                "status" => "received",
                "description" => "Delivery items have been received"
            ],
            [
                "id" => 5,
                "status" => "planned",
                "description" => "Delivery is set to happen on a specific day"
            ],
            [
                "id" => 6,
                "status" => "out_for_delivery",
                "description" => "Delivery driver has left to complete schedule with delivery on board"
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_statuses');
    }
};
