---
layout: default
chapitre: true
package: pkg_rh
order: 425
---

# Branch Techniques

## Analyse Techniques

![Analyse Techniques](./images/Instalar-Laravel-con-Apache-y-MySQL.png)
*Figure: Analyse Techniques*

Pour le développement du prototype, nous utiliserons diverses technologies, parmi lesquelles :

- PHP : un langage de script côté serveur. 
  - Rôle : gérer la logique métier de l’application, traiter les requêtes et générer des pages dynamiques.
- MySQL : une base de données relationnelle. 
  - Rôle : stocker et gérer les données de l’application.
- Laravel : un framework PHP. 
  - Rôle : simplifier le développement en fournissant une structure MVC, des outils de migration de base de données, etc.
- AdminLTE : un thème d’administration basé sur Bootstrap. 
  - Rôle : offrir une interface utilisateur moderne et réactive pour la gestion de l’application.
- Apache : un serveur web open-source.
  - Rôle : héberger l'application web et servir les pages web aux utilisateurs en réponse à leurs requêtes.
- Composer : un gestionnaire de dépendances pour PHP.
  - Rôle : gérer les bibliothèques et les packages nécessaires au projet, facilitant ainsi l'installation et les mises à jour des dépendances.

## Architecture MVC

![Architecture MVC](./images/mvc.jpg)
*Figure: Architecture MVC*

L'architecture MVC (Modèle-Vue-Contrôleur) est une approche de conception qui divise une application en trois composants distincts, ce qui facilite la maintenance et l'évolution du code. Le Modèle s'occupe de la gestion des données, la Vue présente ces données à l'utilisateur, et le Contrôleur gère les interactions entre l'utilisateur et l'application. Utilisée couramment dans le développement de sites web, d'applications mobiles et autres logiciels, cette architecture améliore l'organisation du code, permet une meilleure réutilisabilité et simplifie la maintenance.

## Prototype

![Prototype](./images/Prototype.PNG)
*Figure: Prototype*

Dans le Prototype nous réalisé une application qui permet de gestion des Projets, utilisant Laravel, MySQL, AdminLTE, Repository Design Pattern.
