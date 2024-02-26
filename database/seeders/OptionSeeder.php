<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options = [
            ['name' => 'piscine'],
            ['name' => 'salle de bain'],
            ['name' => 'chambre'],
            ['name' => 'parking'],
            ['name' => 'jardin'],
            ['name' => 'balcon'],
            ['name' => 'wifi'],
            ['name' => 'cuisine équipée'],
            ['name' => 'lave-linge'],
            ['name' => 'sèche-linge'],
            ['name' => 'climatisation'],
            ['name' => 'chauffage'],
            ['name' => 'télévision'],
            ['name' => 'jacuzzi'],
        ];

        DB::table('options')->insert($options);
    }
}
