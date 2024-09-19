---
layout: default
chapitre: true
package : pkg_realisation_projets
order: 435
---



# Branche technique 
{:class="sectionHeader"}

<!-- new slide -->

## Analyse technique

![Analyse technique](/soli-lms/pkg_realisation_projets/branche-technique/Analyse technique.png){:width="300px"}
*Figure: Analyse technique*

<!-- note -->

Pour le développement de le prototype, ont va utiliser de différentes technologies, notamment :

PHP: est un langage de script côté serveur.
Rôle : Gérer la logique métier de l’application, traiter les requêtes et générer des pages dynamiques.
MySQL : est une base de données relationnelle.
Rôle : Stocker et gérer les données de l’application.
Laravel: est un framework PHP.
Rôle : Faciliter le développement en fournissant une structure MVC, des outils de migration de base de données, etc.
AdminLTE: est un thème d’administration basé sur Bootstrap.
Rôle: Offrir une interface utilisateur moderne et réactive pour la gestion de l’application.
Pour la mise en place des tests unitaires, on va séparer les tâches entre le frontend et le backend :

Test unitaire : Séparation des tâches en frontend et backend pour l’ajout de tests unitaires.

Interfaces : Les développeurs ne respectent pas les méthodes.

<!-- new slide -->

## Architecture mvc :

![Architecture mvc](/soli-lms/pkg_realisation_projets/branche-technique/ripository.png)
_Figure : Cart d'empathie : Architecture mvc_

<!-- note -->

Notre application adopte une architecture basée sur le Modèle-Vue-Contrôleur (MVC), enrichie d'une couche supplémentaire correspondant au modèle Repository Pattern.

Le Modèle-Vue-Contrôleur (MVC) est une architecture logicielle qui divise l'application en trois composants principaux : le modèle, la vue et le contrôleur. Le modèle représente les données et la logique métier de l'application, la vue affiche ces données aux utilisateurs, tandis que le contrôleur gère les entrées utilisateur et coordonne les interactions entre le modèle et la vue.

L'ajout du modèle Repository Pattern introduit une couche d'abstraction supplémentaire, séparant la logique de stockage des données de la logique métier de l'application. Cette couche se charge de l'accès aux données, de leur persistance et de leur récupération, ce qui améliore la maintenabilité et l'évolutivité de l'application.

Grâce à cette architecture, nous avons pu séparer efficacement les différentes responsabilités de notre application, facilitant ainsi sa maintenance et son évolution future.
<!-- new slide -->

## Prototype 

<!-- new slide -->