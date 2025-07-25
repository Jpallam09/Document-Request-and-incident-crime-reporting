<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
public function up()
{
    Schema::create('incident_report_images', function (Blueprint $table) {
        $table->id();
        $table->foreignId('incident_report_user_id')->constrained()->onDelete('cascade');
        $table->string('file_path');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incident_report_images');
    }
};
