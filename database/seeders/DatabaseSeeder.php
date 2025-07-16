<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Call the DemoUsersSeeder to populate the database with demo users
        $this->call(DemoUsersSeeder::class);
        $this->call([ProductionAccountsSeeder::class,]);
        // You can add more seeders here as needed
        // $this->call(AnotherSeeder::class);
    }
}
