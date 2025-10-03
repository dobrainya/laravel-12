<?php

namespace Database\Seeders;

use App\Models\Reference;
use App\Models\References;
use Illuminate\Database\Seeder;

class ReferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reference::create(['name' => 'Income', 'code' => References::INCOME]);
        Reference::create(['name' => 'Expense', 'code' => References::EXPENSE]);
    }
}
