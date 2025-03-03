<?php

use App\Models\Client;
use App\Models\Delivery;
use App\Models\DeliveryStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('delivery_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Delivery::class);
            $table->string("package_name");
            $table->string("package_description")->nullable()->default(null);
            $table->integer("weight")->nullable()->default(null);
            $table->integer("height")->nullable()->default(null);
            $table->integer("length")->nullabel()->default(null);
            $table->integer("width")->nullable()->default(null);
            $table->foreignIdFor(DeliveryStatus::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_packages');
    }
};
