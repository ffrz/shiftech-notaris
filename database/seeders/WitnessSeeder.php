<?php

namespace Database\Seeders;

use App\Models\Witness;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class WitnessSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Witness::truncate();
        Schema::enableForeignKeyConstraints();

        Witness::factory()
            ->count(25)
            ->create();
    }
}
