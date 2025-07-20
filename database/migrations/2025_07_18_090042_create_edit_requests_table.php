<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('edit_requests', function (Blueprint $table) {
            $table->id();

            // Foreign keys
            $table->foreignId('incident_report_id')
                  ->constrained('incident_report_users')
                  ->onDelete('cascade');

            $table->foreignId('requested_by')
                  ->constrained('users')
                  ->onDelete('cascade');

            // Fields that may be changed
            $table->string('requested_title', 150)->nullable();
            $table->text('requested_description')->nullable();
            $table->enum('requested_type', ['Safety', 'Security', 'Operational', 'Environmental'])->nullable();
            $table->json('requested_image')->nullable();
            // Request tracking
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamp('requested_at')->nullable();
            $table->timestamp('reviewed_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('edit_requests');
    }
};
