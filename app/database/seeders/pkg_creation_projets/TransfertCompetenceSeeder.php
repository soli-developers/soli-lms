<?php

namespace Database\Seeders\pkg_creation_projets;

use App\Models\pkg_creation_projets\TransfertCompetence;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class TransfertCompetenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        TransfertCompetence::truncate();
        Schema::enableForeignKeyConstraints();

        $csvFile = fopen(base_path("database/data/pkg_creation_projets/TransfertCompetences.csv"), "r");
        $firstline = true;

        while (($data = fgetcsv($csvFile)) !== FALSE) {
            if (!$firstline) {
                TransfertCompetence::create([
                    'projet_id' => $data[0],
                    'competence_id' => $data[1],
                    'appreciation_id' => $data[2],
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
