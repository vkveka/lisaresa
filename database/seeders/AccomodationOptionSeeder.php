<?php

namespace Database\Seeders;

use App\Models\AccomodationOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccomodationOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AccomodationOption::factory(10)->create();
    }
}
