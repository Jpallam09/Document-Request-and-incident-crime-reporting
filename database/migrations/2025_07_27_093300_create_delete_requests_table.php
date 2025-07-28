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
        Schema::create('delete_requests', function (Blueprint $table) {
            $table->id();
            // Who is requesting the delete
            $table->unsignedBigInteger('user_id');
            // Which report they're requesting to delete
            $table->unsignedBigInteger('report_id');
            // Optional reason for requesting deletion
            $table->text('reason')->nullable();
            // Status: pending / accepted / rejected
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            // Timestamp when the request was made
            $table->timestamp('requested_at')->nullable();
            $table->timestamps();
            // Foreign keys
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');
            $table->foreign('report_id')->references('id')
                ->on('incident_report_users')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delete_requests');
    }
};
