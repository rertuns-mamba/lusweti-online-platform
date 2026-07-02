<?php

namespace Database\Seeders;

use App\Models\Cube;
use Illuminate\Database\Seeder;

class CubeSeeder extends Seeder
{
    public function run(): void
    {
        Cube::firstOrCreate(['id' => 1], [
            'front' => 'Welcome',
            'back' => 'you',
            'right' => 'all',
            'left' => 'in',
            'top' => 'our',
            'bottom' => 'livestream',
        ]);
    }
}