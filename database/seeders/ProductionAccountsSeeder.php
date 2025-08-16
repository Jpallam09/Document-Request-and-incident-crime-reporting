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
        // Existing accounts
        $accounts = [
            [
                'email'      => 'incident_admin@example.com',
                'first_name' => 'Incident',
                'last_name'  => 'Admin',
                'role'       => 'admin',
                'app'        => 'incident_reporting',
            ],
            [
                'email'      => 'incident_staff@example.com',
                'first_name' => 'Incident',
                'last_name'  => 'Staff',
                'role'       => 'staff',
                'app'        => 'incident_reporting',
            ],
            [
                'email'      => 'doc_admin@example.com',
                'first_name' => 'Document',
                'last_name'  => 'Admin',
                'role'       => 'admin',
                'app'        => 'document_request',
            ],
            [
                'email'      => 'doc_staff@example.com',
                'first_name' => 'Document',
                'last_name'  => 'Staff',
                'role'       => 'staff',
                'app'        => 'document_request',
            ],
        ];

        // Add 5 extra staff accounts for incident_reporting
        for ($i = 1; $i <= 5; $i++) {
            $accounts[] = [
                'email'      => "incident_staff{$i}@example.com",
                'first_name' => "IncidentStaff{$i}",
                'last_name'  => "User{$i}",
                'role'       => 'staff',
                'app'        => 'incident_reporting',
            ];
        }

        foreach ($accounts as $account) {
            // create user if it doesn’t exist
            /** @var \App\Models\User $user */
            $user = User::firstOrCreate(
                ['email' => $account['email']],
                [
                    'first_name' => $account['first_name'],
                    'last_name'  => $account['last_name'],
                    'user_name'  => $account['first_name'].' '.$account['last_name'],
                    'password'   => Hash::make(env('DEFAULT_ADMIN_PASSWORD', 'Admin@123')),
                ]
            );

            // link role to user & app
            UserRole::firstOrCreate([
                'user_id' => $user->id,
                'app'     => $account['app'],
                'role'    => $account['role'],
            ]);
        }
    }
}
