<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserRole;

class DemoUsersSeeder extends Seeder
{
    public function run(): void
    {
        // $faker = Faker::create();

        // // ✅ Disable foreign key checks temporarily
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // // ✅ Clear the data in the correct order
        // UserRole::truncate(); // No foreign key on this
        // User::truncate();     // Now allowed

        // // ✅ Enable foreign key checks again
        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // /* ---------------- INCIDENT‑REPORTING ADMINS (10) ---------------- */
        // for ($i = 1; $i <= 10; $i++) {
        //     $email = "ir_admin_{$i}@example.com";

        //     $admin = User::create([
        //         'first_name' => $faker->firstName,
        //         'last_name'  => $faker->lastName,
        //         'name'       => $faker->name,
        //         'email'      => $email,
        //         'password'   => Hash::make('password'),
        //     ]);

        //     UserRole::create([
        //         'user_id' => $admin->id,
        //         'app'     => 'incident_reporting',
        //         'role'    => 'admin',
        //     ]);
        // }

        // /* ---------------- INCIDENT‑REPORTING STAFF (10) ----------------- */
        // for ($i = 1; $i <= 10; $i++) {
        //     $email = "ir_staff_{$i}@example.com";

        //     $staff = User::create([
        //         'first_name' => $faker->firstName,
        //         'last_name'  => $faker->lastName,
        //         'name'       => $faker->name,
        //         'email'      => $email,
        //         'password'   => Hash::make('password'),
        //     ]);

        //     UserRole::create([
        //         'user_id' => $staff->id,
        //         'app'     => 'incident_reporting',
        //         'role'    => 'staff',
        //     ]);
        // }

        // /* --------------- GENERAL USERS (100 – both apps) --------------- */
        // for ($i = 1; $i <= 100; $i++) {
        //     $email = "demo_user_{$i}@example.com";

        //     $user = User::create([
        //         'first_name' => $faker->firstName,
        //         'last_name'  => $faker->lastName,
        //         'name'       => $faker->name,
        //         'email'      => $email,
        //         'password'   => Hash::make('password'),
        //     ]);

        //     // incident_reporting access
        //     UserRole::create([
        //         'user_id' => $user->id,
        //         'app'     => 'incident_reporting',
        //         'role'    => 'user',
        //     ]);

        //     // document_request access
        //     UserRole::create([
        //         'user_id' => $user->id,
        //         'app'     => 'document_request',
        //         'role'    => 'user',
        //     ]);
        // }
    }
}
