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
    public function up(): void
    {
        Schema::table('edit_requests', function (Blueprint $table) {
            $table->date('requested_report_date')->nullable()->after('requested_type');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('edit_requests', function (Blueprint $table) {
            $table->dropColumn('requested_report_date');
        });
    }
};
