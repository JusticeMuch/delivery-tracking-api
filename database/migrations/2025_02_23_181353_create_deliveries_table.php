<?php

use App\Models\Address;
use App\Models\Client;
use App\Models\DeliveryRegion;
use App\Models\DeliverySchedule;
use App\Models\DeliveryStatus;
use App\Models\Driver;
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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Client::class);
            $table->foreignIdFor(Address::class);
            $table->foreignIdFor(DeliverySchedule::class)->nullable()->default(null);
            $table->timestamp("scheduled_date")->nullable()->default(null);
            $table->timestamp("delivery_completed")->nullable()->default(null);;
            $table->foreignIdFor(DeliveryStatus::class);
            $table->bigInteger("rescheduled_delivery_id")->nullable()->default(null)->index();
            $table->string("special_delivery_instructions")->nullable()->default(null);
            $table->string("tracking_code");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
