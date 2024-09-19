<?php

namespace Database\Seeders\pkg_formations;

use App\Models\pkg_formations\Formation;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $csvFile = fopen(base_path("database/data/pkg_formations/formations.csv"), "r");
        $firstline = true;
        $i = 0;
        while (($data = fgetcsv($csvFile)) !== FALSE) {
            if (!$firstline) {
                Formation::create([
                    "nom"=>$data['0'],
                    "description"=>$data['1'],
                    "lien"=>$data['2'],
                    "lien1"=>$data['3']
                ]);
            }
            $firstline = false;

        }
    }
}
