<?php

use App\Models\DeliveryRegion;
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
        Schema::create('delivery_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Driver::class);
            $table->foreignIdFor(DeliveryRegion::class);
            $table->timestamp("delivery_date");
            $table->integer("amount_of_deliveries")->nullable()->default(null);
            $table->integer("deliveries_completed")->nullable()->default(null);
            $table->boolean("delivery_completed")->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_schedules');
    }
};
