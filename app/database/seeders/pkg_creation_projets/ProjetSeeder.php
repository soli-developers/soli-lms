<?php

namespace Database\Seeders\pkg_creation_projets;

use App\Models\pkg_creation_projets\Projet;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ProjetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = fopen(base_path("database/data/pkg_creation_projets/permissions.csv"), "r");
        $firstline = true;
        $FormateurRole = Role::where('name', User::FORMATEUR)->first();
        $ApprenantRole = Role::where('name', User::APPRENANT)->first();

        while (($data = fgetcsv($csvFile)) !== FALSE) {
            if (!$firstline) {
                Permission::create([
                    "name" => $data['0'],
                    "guard_name" => 'web',
                ]);

                if ($FormateurRole) {
                    // If the role exists, update its permissions
                    $FormateurRole->givePermissionTo($data['0']);
                    if (in_array($data['0'], ['index-ProjetController', 'show-ProjetController', 'export-ProjetController'] )) {
                        $ApprenantRole->givePermissionTo($data['0']);
                    }
                } else {
                    // If the role doesn't exist, create it and give permissions
                    Role::create([
                        'name' => User::FORMATEUR,
                        'guard_name' => 'web',
                    ])->givePermissionTo($data['0']);
                }


                if ($ApprenantRole) {
                    if (in_array($data['0'], ['index-ProjetController', 'show-ProjetController', 'export-ProjetController'] )) {
                        $ApprenantRole->givePermissionTo($data['0']);
                    }
                } else {
                    // If the role doesn't exist, create it and give permissions
                    if (in_array($data['0'], ['index-ProjetController', 'show-ProjetController', 'export-ProjetController'] )) {
                        Role::create([
                            'name' => User::APPRENANT,
                            'guard_name' => 'web',
                        ])->givePermissionTo($data['0']);
                    }
                }
            }
            $firstline = false;
        }
        Schema::disableForeignKeyConstraints();
        Projet::truncate();
        Schema::enableForeignKeyConstraints();

        $csvFile = fopen(base_path("database/data/pkg_creation_projets/Projets.csv"), "r");
        $firstline = true;

        while (($data = fgetcsv($csvFile)) !== FALSE) {
            if (!$firstline) {
                Projet::create([
                    'titre' => $data[0],
                    'description' => $data[1],
                    'travailAFaire' => $data[2],
                    'critereDeTravail' => $data[3],
                    'dateDebut' => $data[4],
                    'dateFin' => $data[5],
                    'formateur_id'=>$data[6],
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
