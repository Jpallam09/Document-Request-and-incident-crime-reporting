<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Only seed demo/test data
        $this->call(DemoUsersSeeder::class);
        $this->call(IncidentReportingSeeder::class);
    }
}
