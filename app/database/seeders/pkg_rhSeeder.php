<?php

namespace Database\Seeders;

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
            NiveauScholaireSeeder::class,
            SpecialiteSeeder::class,
            VilleSeeder::class,
            PersonneSeeder::class,
        ];
    }
}
