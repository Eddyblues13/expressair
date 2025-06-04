<?php

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
        Schema::create('tracking_locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->constrained()->onDelete('cascade');
            $table->string('location_name')->nullable();      // e.g., Denver
            $table->string('status')->nullable(); // e.g., 'Current Location', 'Est. Jun 15'
            $table->timestamp('arrival_time')->nullable(); // e.g., Jun 10, 10:30 AM
            $table->boolean('is_current')->default(false); // marks if it's the active location
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracking_locations');
    }
};
