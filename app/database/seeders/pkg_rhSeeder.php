<?php

namespace Database\Seeders;

use Database\Seeders\pkg_rh\VilleSeeder;
use Database\Seeders\pkg_rh\SpecialiteSeeder;
use Database\Seeders\pkg_rh\NiveauScolaireSeeder;
use Database\Seeders\pkg_rh\GroupeSeeder;
use Database\Seeders\pkg_rh\PersonneSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class pkg_rhSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(pkg_rhSeeder::Classes());
    }
    public static function Classes(): array
    {
        return [
            GroupeSeeder::class,
            NiveauScolaireSeeder::class,
            SpecialiteSeeder::class,
            VilleSeeder::class,
            PersonneSeeder::class,
        ];
    }
}
