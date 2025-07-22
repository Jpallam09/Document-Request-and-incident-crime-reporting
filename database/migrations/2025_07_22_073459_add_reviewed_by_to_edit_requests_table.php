<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('edit_requests', function (Blueprint $table) {
            $table->foreignId('reviewed_by')
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('set null'); // Optional: if user is deleted, clear reviewer
        });
    }

    public function down(): void
    {
        Schema::table('edit_requests', function (Blueprint $table) {
            $table->dropForeign(['reviewed_by']);
            $table->dropColumn('reviewed_by');
        });
    }
};
