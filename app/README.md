# Installation Laravel

## Ajouter un Spin de chargement

- Ajoutez ceci *id="tableForm"* à votre table dans la page d'index pour afficher la rotation de chargement lors de la recherche

```html
    <div class="card-header col-md-12" id="tableForm" id="tableForm"> 
        <div class="input-group input-group-sm float-sm-right col-md-3 p-0">
            <input type="text" name="table_search" id="table_search" class="form-control float-right" placeholder="Recherche">
            <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>
```

## Installation de PHP


PHP 8.2.11 (cli) (construit le 1er octobre 2021 à 15h00) ou une version plus récente est requise.

## Guide de Démarrage pour Lab CRUD

1. Ouvrez votre terminal.
2. Accédez au répertoire app

```bash
cd app
```
3. Installer les dépendances Composer :

```bash
composer install
npm install
```


4. Créer un fichier .env en copiant .env.example :
   
```bash
cp .env.example .env
```

5. Configuration de la Base de Données pour un Projet Laravel
   
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=database_name
DB_USERNAME=root
DB_PASSWORD=password
```
6. Générer une clé d'application avec artisan :

```bash
php artisan key:generate
```
7. Migrer la base de données :

```bash
php artisan migrate
```
8. Exécuter les seeders pour peupler la base de données :
   
```bash
php artisan db:seed
```

9. Installer les dépendances npm :

```bash
php artisan serve
```

- Compiler les assets avec npm : après la modification des scripts 


```bash
npm run build
```

<!-- TODO :Loin and password   -->
## Login and password 

- **Apprenants:**
    - **Emails:**
        - hamza@solicode.co
        - Imrane@solicode.co
        - reda@solicode.co
        - Amine@solicode.co
        - Adnan@solicode.co
        - Safaa@solicode.co
        - Yasmine@solicode.co
        - Soufian@solicode.co
        - Hussein@solicode.co
        - jalil@solicode.co
        - amina@solicode.co
        - Hamid@solicode.co
    - **Password**
        - apprenant
- **Formateures:**
    - **Emails:**
        - Fouad@solicode.co
    - **Password**
        - formateur
- **Responsable:**
    - **Emails:**
        - hammouda@solicode.co
    - **Password**
        - responsable
