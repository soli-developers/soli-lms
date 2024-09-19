<?php

namespace Database\Seeders\pkg_competences;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use App\Models\pkg_competences\Technologie;
use App\Models\pkg_notifications\Notification;
use Spatie\Permission\Models\Role;

class TechnologieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ==========================================================
        // ================= Add Seeder Technologies ================
        // ==========================================================
        Schema::disableForeignKeyConstraints();
        Technologie::truncate();
        Schema::enableForeignKeyConstraints();

        $csvFile = fopen(base_path("database/data/pkg_competences/Technologies.csv"), "r");
        $firstline = true;
        while (($data = fgetcsv($csvFile, 1000, ",")) !== FALSE) {
            if (!$firstline) {
                Technologie::create([
                    "nom" => $data[0],
                    "description" => $data[1],
                    "competence_id" => $data[2],
                    "categorie_technologie_id" => $data[3],
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
        $FormateurRole = User::FORMATEUR;
        $Role = Role::where('name', $FormateurRole)->first();
        $csvFile = fopen(base_path("database/data/pkg_competences/TechnologiePermission.csv"), "r");
        $firstline = true;
        while (($data = fgetcsv($csvFile)) !== FALSE) {
            if (!$firstline) {
                Permission::create([
                    "name" => $data['0'],
                    "guard_name" => $data['1'],
                ]);

                if ($Role) {
                    // If the role exists, update its permissions
                    $Role->givePermissionTo($data['0']);
                } 
            }
            $firstline = false;
        }
        fclose($csvFile);
