<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

use function PHPSTORM_META\map;

class ServiceSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Service::truncate();
        Schema::enableForeignKeyConstraints();

        Service::create([
            'name' => 'Pendirian PT',
            'price' => 7000000,
            'active' => true,
        ]);

        Service::create([
            'name' => 'Perubahan PT',
            'price' => 1000000,
            'active' => true,
        ]);

        Service::create([
            'name' => 'Penutupan PT',
            'price' => 1000000,
            'active' => true,
        ]);

        Service::create([
            'name' => 'Pendirian CV',
            'price' => 3500000,
            'active' => true,
        ]);

        Service::create([
            'name' => 'Perubahan CV',
            'price' => 750000,
            'active' => true,
        ]);

        Service::create([
            'name' => 'Penutupan CV',
            'price' => 750000,
            'active' => true,
        ]);

        Service::create([
            'name' => 'Pendirian Yayasan',
            'price' => 1000000,
            'active' => true,
        ]);

        Service::create([
            'name' => 'Perubahan Yayasan',
            'price' => 250000,
            'active' => true,
        ]);

        Service::create([
            'name' => 'Penutupan Yayasan',
            'price' => 250000,
            'active' => true,
        ]);

        Service::create([
            'name' => 'PPAT JB Tanah',
            'price' => 250000,
            'active' => true,
        ]);

        Service::create([
            'name' => 'PPAT Hibah',
            'price' => 500000,
            'active' => true,
        ]);

        Service::create([
            'name' => 'SKMHT',
            'price' => 250000,
            'active' => true,
        ]);

        Service::create([
            'name' => 'APHT',
            'price' => 750000,
            'active' => true,
        ]);

        Service::create([
            'name' => 'APHB',
            'price' => 750000,
            'active' => true,
        ]);
    }
}
