<?php

namespace Database\Seeders;

use App\Models\Stream;
use Illuminate\Database\Seeder;

class ResetStreamStatusSeeder extends Seeder
{
    public function run(): void
    {
        Stream::query()->update(['is_live' => false]);
        $this->command->info('All streams reset to is_live = false');
    }
}
