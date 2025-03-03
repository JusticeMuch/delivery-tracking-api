<?php

use App\Models\Client;
use App\Models\DeliveryRegion;
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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Client::class)->nullable()->default(null);
            $table->foreignIdFor(DeliveryRegion::class)->nullable()->default(null);
            $table->string("street_address_1")->nullable();
            $table->string("street_address_2")->nullable()->default(null);
            $table->string("suburb")->nullable()->default(null);
            $table->string("post_code")->nullable()->default(null);
            $table->string("city")->nullable()->default(null);
            $table->string("province")->nullable()->default(null);
            $table->string("country")->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
