<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define your direct seed data here
        $subscribers = [
            [
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'phone_number' => '+12345678901',
                'is_active' => true,
                'subscribed_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane.smith@example.com',
                'phone_number' => null, // Testing your nullable column
                'is_active' => false,
                'subscribed_at' => now()->subDays(5),
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],
            [
                'name' => 'Alice Johnson',
                'email' => 'alice.j@example.com',
                'phone_number' => '+447911123456',
                'is_active' => true,
                'subscribed_at' => now()->subWeeks(2),
                'created_at' => now()->subWeeks(2),
                'updated_at' => now()->subWeeks(2),
            ],
        ];

        // Insert the array directly into the database
        DB::table('subscribers')->insert($subscribers);
    }
} 
