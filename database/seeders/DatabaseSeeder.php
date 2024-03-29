<?php

namespace Database\Seeders;

use Database\Factories\CardsFactory;
use Database\Factories\TransferFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CardsSeeder::class,
            TransferSeeder::class,
        ]);
    }
}
