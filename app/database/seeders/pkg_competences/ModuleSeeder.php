<?php

namespace Database\Seeders\pkg_competences;

use Spatie\Permission\Models\Role;
use App\Models\pkg_competences\Module;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Module::truncate();
        Schema::enableForeignKeyConstraints();

        // Open the CSV file
        $csvFilePath = base_path("database/data/pkg_competences/Module.csv");
        if (!file_exists($csvFilePath) || !is_readable($csvFilePath)) {
            throw new \Exception("CSV file does not exist or is not readable: $csvFilePath");
        }

        $csvFile = fopen($csvFilePath, "r");
        if ($csvFile === false) {
            throw new \Exception("Failed to open CSV file: $csvFilePath");
        }

        $firstline = true;
        while (($data = fgetcsv($csvFile)) !== FALSE) {
            if (!$firstline) {
                if (count($data) >= 5) {
                    Module::create([
                        "N" => $data[0],
                        "nom" => $data[1],
                        "description" => $data[2],
                        "masse_horaire" => floatval($data[3]),
                        "filiere_id" => intval($data[4]),
                    ]);
                } else {
                    error_log("Skipping malformed row in Module.csv: " . implode(',', $data));
                }
            }
            $firstline = false;
        }

        fclose($csvFile);

        // ==========================================================
        // =========== Add Seeder Permission Assign Role ============
        // ==========================================================

        $responsableRole = User::RESPONSABLE;
        $role = Role::where('name', $responsableRole)->first();

        $csvFilePath = base_path("database/data/pkg_competences/ModulePermission.csv");
        if (!file_exists($csvFilePath) || !is_readable($csvFilePath)) {
            throw new \Exception("CSV file does not exist or is not readable: $csvFilePath");
        }

        $csvFile = fopen($csvFilePath, "r");
        if ($csvFile === false) {
            throw new \Exception("Failed to open CSV file: $csvFilePath");
        }

        $firstline = true;
        while (($data = fgetcsv($csvFile)) !== FALSE) {
            if (!$firstline) {
                if (count($data) >= 2) {
                    Permission::create([
                        "name" => $data[0],
                        "guard_name" => $data[1],
                    ]);

                    if ($role) {
                        $role->givePermissionTo($data[0]);
                    }
                } else {
                    error_log("Skipping malformed row in ModulePermission.csv: " . implode(',', $data));
                }
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
