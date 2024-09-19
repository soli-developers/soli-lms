---
layout: default
chapitre: true
package : pkg_global
order: 290
---

## Creation de base de données
### Création des models et des migrations

1. **`pkg_authentification` namespace:**

```bash
php artisan make:model pkg_authentification/User -m
php artisan make:model pkg_authentification/Role -m
```

2. **`pkg_rh` namespace:**

```bash
php artisan make:model pkg_rh/Personne -m
php artisan make:model pkg_rh/Formateur -m
php artisan make:model pkg_rh/Apprenant -m
php artisan make:model pkg_rh/Groupe -m
php artisan make:model pkg_rh/Ville -m
php artisan make:model pkg_rh/NiveauScolaire -m
php artisan make:model pkg_rh/Specialite -m
```

3. **`pkg_competences` namespace:**

```bash
php artisan make:model pkg_competences/Competence -m
php artisan make:model pkg_competences/NiveauCompetence -m
php artisan make:model pkg_competences/Technologie -m
php artisan make:model pkg_competences/CategorieTechnologie -m
php artisan make:model pkg_competences/Appreciation -m
```

4. **`pkg_creation_projets` namespace:**

```bash
php artisan make:model pkg_creation_projets/Projet -m
php artisan make:model pkg_creation_projets/Resource -m
php artisan make:model pkg_creation_projets/Livrable -m
php artisan make:model pkg_creation_projets/NatureLivrable -m
php artisan make:model pkg_creation_projets/TransfertCompetence -m
```

5. **`pkg_realisation_projets` namespace:**

```bash
php artisan make:model pkg_realisation_projets/RealisationProjet -m
php artisan make:model pkg_realisation_projets/LivrableRealisation -m
php artisan make:model pkg_realisation_projets/EtatRealisationProjet -m
```

6. **`pkg_validations` namespace:**

```bash
php artisan make:model pkg_validations/Validation -m
php artisan make:model pkg_validations/Message -m
```

7. **`pkg_formations` namespace:**

```bash
php artisan make:model pkg_formations/Formation -m
```

8. **`pkg_realisation_tache` namespace:**

```bash
php artisan make:model pkg_realisation_tache/RealisationTache -m
php artisan make:model pkg_realisation_tache/EtatRealisationTache -m
```

9. **`pkg_creation_tache` namespace:**

```bash
php artisan make:model pkg_creation_tache/Tache -m
```

### Création des seeders




1. **`pkg_authentification` namespace:**

```bash
php artisan make:seeder pkg_authentification/UserSeeder
php artisan make:seeder pkg_authentification/RoleSeeder
```

2. **`pkg_rh` namespace:**

```bash
php artisan make:seeder pkg_rh/PersonneSeeder
php artisan make:seeder pkg_rh/FormateurSeeder
php artisan make:seeder pkg_rh/ApprenantSeeder
php artisan make:seeder pkg_rh/GroupeSeeder
php artisan make:seeder pkg_rh/VilleSeeder
php artisan make:seeder pkg_rh/NiveauScolaireSeeder
php artisan make:seeder pkg_rh/SpecialiteSeeder
```

3. **`pkg_competences` namespace:**

```bash
php artisan make:seeder pkg_competences/CompetenceSeeder
php artisan make:seeder pkg_competences/NiveauCompetenceSeeder
php artisan make:seeder pkg_competences/TechnologieSeeder
php artisan make:seeder pkg_competences/CategorieTechnologieSeeder
php artisan make:seeder pkg_competences/AppreciationSeeder
```

4. **`pkg_creation_projets` namespace:**

```bash
php artisan make:seeder pkg_creation_projets/ProjetSeeder
php artisan make:seeder pkg_creation_projets/ResourceSeeder
php artisan make:seeder pkg_creation_projets/LivrableSeeder
php artisan make:seeder pkg_creation_projets/NatureLivrableSeeder
php artisan make:seeder pkg_creation_projets/TransfertCompetenceSeeder
```

5. **`pkg_realisation_projets` namespace:**

```bash
php artisan make:seeder pkg_realisation_projets/RealisationProjetSeeder
php artisan make:seeder pkg_realisation_projets/LivrableRealisationSeeder
php artisan make:seeder pkg_realisation_projets/EtatRealisationProjetSeeder
```

6. **`pkg_validations` namespace:**

```bash
php artisan make:seeder pkg_validations/ValidationSeeder
php artisan make:seeder pkg_validations/MessageSeeder
```

7. **`pkg_formations` namespace:**

```bash
php artisan make:seeder pkg_formations/FormationSeeder
```

8. **`pkg_realisation_tache` namespace:**

```bash
php artisan make:seeder pkg_realisation_tache/RealisationTacheSeeder
php artisan make:seeder pkg_realisation_tache/EtatRealisationTacheSeeder
```

9. **`pkg_creation_tache` namespace:**

```bash
php artisan make:seeder pkg_creation_tache/TacheSeeder
```
10. **Seeder de chaque package:**

```bash
php artisan make:seeder pkg_authentificationSeeder
php artisan make:seeder pkg_rhSeeder
php artisan make:seeder pkg_competencesSeeder
php artisan make:seeder pkg_creation_projetsSeeder
php artisan make:seeder pkg_realisation_projetsSeeder
php artisan make:seeder pkg_validationsSeeder
php artisan make:seeder pkg_formationsSeeder
php artisan make:seeder pkg_realisation_tacheSeeder
php artisan make:seeder pkg_creation_tacheSeeder
```

