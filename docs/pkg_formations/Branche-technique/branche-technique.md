---
layout: default
chapitre: true
package : pkg_formations
order: 450
---


##  Branche technique
{:class="sectionHeader"}

<!-- new slide -->

## Analyse technique

![Analyse technique](./images/analyse-technique.png){:width="900px"}
*Figure: Analyse technique*

<!-- note -->

Le développement du prototype de notre plateforme de gestion des formations et d'apprentissage s'appuiera sur un ensemble de technologies robustes et performantes :

**Langages et Frameworks :**

- **PHP:**  Langage de script côté serveur pour gérer la logique métier, le traitement des requêtes et la génération de pages dynamiques.
- **Laravel:** Framework PHP pour accélérer le développement, structurer l'application (MVC), gérer les migrations de base de données, etc.
- **JavaScript:** Langage de programmation côté client pour dynamiser l'interface utilisateur et offrir une expérience utilisateur fluide. 

**Base de données et administration:**

- **MySQL:** Système de gestion de base de données relationnelle pour stocker et gérer efficacement les données de la plateforme.
- **AdminLTE:** Thème d'administration basé sur Bootstrap pour une interface utilisateur intuitive, moderne et responsive, facilitant l'administration de la plateforme.

**Tests et qualité du code:**

- **Tests unitaires:** Mise en place de tests unitaires distincts pour le frontend et le backend afin de garantir la fiabilité et la robustesse du code.
- **Respect des interfaces:**  Application rigoureuse des interfaces pour assurer la cohérence du code et faciliter la maintenance et l'évolution future de la plateforme. 


<!-- new slide -->

## Architecture MVC : un choix structurant

![Architecture mvc](./images/Architecture-mvc.png){:width="100%" height="500px"}
_Figure : Architecture MVC_

<!-- note -->

L'architecture MVC (Modèle-Vue-Contrôleur) sera au cœur du développement de la plateforme. Ce choix architectural offre de nombreux avantages : 

- **Séparation claire des responsabilités :** 
    - Le **Modèle** gère les données et la logique métier. 
    - La **Vue** se concentre sur la présentation des données à l'utilisateur (interface).
    - Le **Contrôleur** assure la liaison entre le modèle et la vue en traitant les actions de l'utilisateur et en mettant à jour les données.
- **Maintenance et évolutivité accrues :**  La séparation des couches facilite la modification et l'extension du code sans impacter les autres parties de l'application.
- **Réutilisation du code optimisée :**  Les composants (modèles, vues, contrôleurs) peuvent être réutilisés dans différents contextes, accélérant ainsi le développement.

<!-- new slide -->

## Prototype : vers une concrétisation 

<!-- new slide --> 
