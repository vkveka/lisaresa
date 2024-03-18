<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'firstname' => 'admin',
            'lastname' => 'admin',
            'email' => 'admin@admin.fr',
            'password' => Hash::make('Azerty99@'),
            'image' => 'user.png',
            'remember_token' => Str::random(10),
            'role_id' => 1,
        ]);
        
        User::create([
            'firstname' => 'user',
            'lastname' => 'user',
            'email' => 'user@user.fr',
            'password' => Hash::make('Azerty99@'),
            'image' => 'user.png',
            'remember_token' => Str::random(10),
            'role_id' => 2,
        ]);

        User::factory(28)->create();
    }
}
