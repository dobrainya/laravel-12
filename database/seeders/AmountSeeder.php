<?php

namespace Database\Seeders;

use App\Models\Amount;
use Illuminate\Database\Seeder;

class AmountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Amount::factory()->count(10000)->create();
    }
}
