<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\pkg_formations\{

    FormationSeeder,
    ApprenantsTableSeeder,
    FormateursTableSeeder,
};

class pkg_formationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(pkg_formationsSeeder::Classes());
    }

    public static function Classes(): array
    {
        return [

            FormationSeeder::class,

        ];
    }

}
