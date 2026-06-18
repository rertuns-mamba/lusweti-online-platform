<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Creates or updates the primary developer admin profile
        $admin = User::updateOrCreate(
            ['email' => 'admin@lusweti.com'], // Your deterministic login username
            [
                'name' => 'Lusweti Admin',
                'password' => Hash::make('password123'), // Your deterministic password
                'email_verified_at' => now(),
            ]
        );

        // Optional: If you have already built out your Spatie Roles setup:
        if (class_exists(\Spatie\Permission\Models\Role::class)) {
            $role = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'Super Admin']);
            $admin->assignRole($role);
        }
    }
}
