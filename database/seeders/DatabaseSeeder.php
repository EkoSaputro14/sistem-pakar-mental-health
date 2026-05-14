<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SymptomSeeder::class,
            DepressionSeeder::class,
            RuleSeeder::class,
            RecommendationSeeder::class,
        ]);

        User::updateOrCreate(
            ['email' => 'admin@demo.test'],
            [
                'name' => 'Admin',
                'role' => 'admin',
                'password' => Hash::make('password'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'mahasiswa@demo.test'],
            [
                'name' => 'Mahasiswa Demo',
                'role' => 'user',
                'password' => Hash::make('password'),
            ]
        );
    }
}
