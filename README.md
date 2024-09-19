# soli-lms

## Guide de Démarrage pour prototype 

1. Ouvrez votre terminal.
2. Accédez au répertoire app
```bash
cd app
```

3. Installer les dépendances Composer :
```bash
composer install
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
php artisan db:seed --class="GestionRHSeeder"
php artisan db:seed --class="GestionCompetencesSeeder"
php artisan db:seed --class="CreationBriefProjetSeeder"
php artisan db:seed --class="RealisationBriefProjetSeeder"
php artisan db:seed --class="GestionValidationsSeeder"


```

9. Installer les dépendances npm :
```bash
npm install
```

9. Démarrer le serveur de développement :

```bash
php artisan serve
```
- Compiler les assets avec npm :
```bash
npm run dev
```

## Login

## Exécution du Serveur de Maquettage Spécial du Projet
1. Ouvrez votre terminal.
2. Accédez au répertoire `maquettes`
```bash
cd maquettes
```
3. Exécutez la commande suivante pour installer les dépendances nécessaires :
```bash
npm install
```
4. Ensuite, lancez le serveur en utilisant la commande :
```bash
php -S localhost:8000
```

## Docs

1. Installer Ruby:
- Téléchargez et installez Ruby depuis le site officiel : [ruby-lang.org](https://www.ruby-lang.org/en/).
- Assurez-vous que Ruby est correctement installé en exécutant ruby -v dans votre terminal.

2. Ouvrez votre terminal.

3. Accédez au répertoire `docs`
```bash
cd docs
```

4. Démarrer le Serveur de Développement:
- Lancez le serveur de développement en utilisant la commande :
```bash
bundle exec jekyll serve
```



## Rapport et présentation global 

- [Rapport](https://solicoders.github.io/soli-lms) 
