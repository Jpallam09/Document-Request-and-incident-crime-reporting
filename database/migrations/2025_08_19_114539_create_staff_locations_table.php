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
        Schema::create('staff_locations', function (Blueprint $table) {
            $table->id();

            // Staff user who is being tracked
            $table->foreignId('staff_id')->constrained('users')->onDelete('cascade');

            // Link to the incident report being tracked
            $table->foreignId('report_id')->constrained('incident_reports')->onDelete('cascade');

            // Current latitude and longitude
            $table->decimal('latitude', 10, 7);   // 10 total digits, 7 decimal places
            $table->decimal('longitude', 10, 7);

            $table->timestamps(); // includes updated_at for live tracking refresh
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_locations');
    }
};
