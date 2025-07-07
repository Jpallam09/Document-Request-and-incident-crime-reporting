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
         Schema::create('incident_report_users', function (Blueprint $table) {
        $table->id();
        $table->string('report_title', 150); // max length 150
        $table->date('report_date');
        $table->enum('report_type', ['Safety', 'Security', 'Operational', 'Environmental']);
        $table->text('report_description'); // no length limit on TEXT
        $table->string('report_image', 255)->nullable(); // 255 is default max length
        $table->boolean('is_actioned')->default(false); // default unchecked
        $table->timestamps(); // created_at, updated_at
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incident_report_users');
    }
};
