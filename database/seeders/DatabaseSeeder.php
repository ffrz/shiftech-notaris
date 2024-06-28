<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            PartySeeder::class,
            WitnessSeeder::class,
            OfficerSeeder::class,
            PartnerSeeder::class,
            ServiceSeeder::class,
            ExpenseCategorySeeder::class,
        ]);
    }
}
