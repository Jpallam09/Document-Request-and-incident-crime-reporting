<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        DB::statement("
          ALTER TABLE `user_roles`
          MODIFY COLUMN `app`
          ENUM('incident_reporting', 'document_request')
          NOT NULL;
        ");
    }

    public function down(): void
    {
        DB::statement("
          ALTER TABLE `user_roles`
          MODIFY COLUMN `app`
          ENUM('reporting', 'request')
          NOT NULL;
        ");
    }
};
