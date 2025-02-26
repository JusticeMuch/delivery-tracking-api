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
        Schema::create('user_roles', function (Blueprint $table) {
            $table->id();
            $table->string("name", 32);
            $table->string("description", 512);
        });

        DB::table("user_roles")->insert([
            [
                "id" => 1,
                "name" => "admin",
                "description" => "User who has permissions to access all functionality",
            ],
            [
                "id" => 2,
                "name" => "client",
                "description" => "User who sends in packages, to be delivered , their is a corresponding 'clients' table associated with this role"
            ],
            [
                "id" => 3,
                "name" => "driver",
                "description" => "User who makes deliveries, their is a corresponding 'drivers' table associated with this role"
            ]
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_roles');
    }
};
