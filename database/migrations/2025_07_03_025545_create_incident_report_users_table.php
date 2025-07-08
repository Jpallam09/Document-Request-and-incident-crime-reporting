<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('incident_report_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('report_title', 150);
            $table->date('report_date');
            $table->enum('report_type', ['Safety', 'Security', 'Operational', 'Environmental']);
            $table->text('report_description');
            $table->string('report_image', 255)->nullable();
            $table->boolean('is_actioned')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('incident_report_users');
    }
};
