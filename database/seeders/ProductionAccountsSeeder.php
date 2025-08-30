<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserRole;

class ProductionAccountsSeeder extends Seeder
{
    public function run(): void
    {
        // Incident reporting admin & staff
        $accounts = [
            [
                'email'      => 'incident_admin@example.com',
                'first_name' => 'Incident',
                'last_name'  => 'Admin',
                'role'       => 'admin',
            ],
            [
                'email'      => 'incident_staff@example.com',
                'first_name' => 'Incident',
                'last_name'  => 'Staff',
                'role'       => 'staff',
            ],
        ];

        // Add 5 extra staff accounts
        for ($i = 1; $i <= 5; $i++) {
            $accounts[] = [
                'email'      => "incident_staff{$i}@example.com",
                'first_name' => "IncidentStaff{$i}",
                'last_name'  => "User{$i}",
                'role'       => 'staff',
            ];
        }

        foreach ($accounts as $account) {
            // Generate an anonymized user_name
            $handle = strtolower($account['first_name'][0] . $account['last_name'] . rand(100, 999));

            // Create user if not exists
            $user = User::firstOrCreate(
                ['email' => $account['email']],
                [
                    'first_name' => $account['first_name'],
                    'last_name'  => $account['last_name'],
                    'user_name'  => $handle,
                    'password'   => Hash::make(env('DEFAULT_ADMIN_PASSWORD', 'Admin@123')),
                ]
            );

            // Link role to user & incident_reporting app
            UserRole::firstOrCreate([
                'user_id' => $user->id,
                'app'     => 'incident_reporting',
                'role'    => $account['role'],
            ]);
        }
    }
}
