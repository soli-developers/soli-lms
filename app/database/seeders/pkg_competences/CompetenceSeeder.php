<?php

namespace Database\Seeders\pkg_competences;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\User;
use App\Models\pkg_competences\Competence;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;



class CompetenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Schema::disableForeignKeyConstraints();
        Competence::truncate();
        Schema::enableForeignKeyConstraints();

        $csvFile = fopen(base_path("database/data/pkg_competences/competences.csv"), "r");
        if ($csvFile === false) {
            throw new \Exception("Could not open the CSV file.");
        }

        $firstline = true;
        while (($data = fgetcsv($csvFile)) !== FALSE) {
            if (!$firstline) {
                Competence::create([
                    "code" => $data[0],
                    "nom" => $data[1],
                    "description" => $data[2],
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}


// ==========================================================
        // =========== Add Seeder Permission Assign Role ============
        // ==========================================================
        $FormateurRole = Role::where('name', User::FORMATEUR)->first();
        $responsableRole = Role::where('name', User::RESPONSABLE)->first();


        $csvFile = fopen(base_path("database/data/pkg_competences/CompetencePermissions.csv"), "r");
        $firstline = true;
        while (($data = fgetcsv($csvFile)) !== FALSE) {
            if (!$firstline) {
                Permission::create([
                    "name" => $data['0'],
                    "guard_name" => $data['1'],
                ]);

                if ($FormateurRole) {
                    // If the role exists, update its permissions
                    $FormateurRole->givePermissionTo($data['0']);
                } 
                

                if ($responsableRole) {
                    // If the role exists, update its permissions
                    if (in_array($data['0'], ['index-CompetenceController', 'show-CompetenceController', 'destroy-CompetenceController','create-CompetenceController','store-CompetenceController','edit-CompetenceController','update-CompetenceController','export-CompetenceController','import-CompetenceController'] )) {
                        $responsableRole->givePermissionTo($data['0']);
                    }
                } 

            }
            $firstline = false;
        }
        fclose($csvFile);

