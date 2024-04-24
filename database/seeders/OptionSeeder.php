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
            ['name' => 'fer à repasser'],
            ['name' => 'bord de mer'],
            ['name' => 'ménage'],
            ['name' => 'avec vue'],
            ['name' => 'cheminée'],
            ['name' => 'Produits de salle de bain'],
            ['name' => 'boîte à clefs'],
            ['name' => 'console de jeux'],
            ['name' => 'bibliothèque'],
            ['name' => 'bouquet TV'],
            ['name' => 'netflix'],
            ['name' => 'canal +'],
        ];

        DB::table('options')->insert($options);
    }
}
