---
layout: default
chapitre: true
package : pkg_suivi
order: 455
---

# Branche technique 

La branche technique se concentre sur les aspects techniques et de développement du projet. Elle englobe les activités liées à la conception, la programmation et la mise en œuvre des fonctionnalités et des composants. Cela inclut l'utilisation d'outils de développement, la gestion des versions du code source et la collaboration entre les développeurs. La branche technique est essentielle pour garantir la création d'un produit final de haute qualité, en assurant le respect des spécifications techniques et la correcte implémentation des fonctionnalités.



## Capture des besoins techniques

Pour le développement de l'application Soli-LMS, nous avons choisi Laravel comme framework backend en raison de sa robustesse et de ses fonctionnalités avancées, et MySQL pour la gestion des données grâce à sa fiabilité. Pour l'interface utilisateur, AdminLTE a été sélectionné pour son design moderne et ses fonctionnalités avancées, assurant une expérience utilisateur conviviale.

En intégrant ces technologies avec des design patterns tels que les repositories, notre objectif est de développer une application solide, performante et facile à utiliser, répondant efficacement aux besoins de gestion de formation. L'utilisation des repositories garantit une séparation claire des préoccupations entre le backend et le frontend, ce qui améliore la maintenabilité, la scalabilité et la performance globale de l'application.



## Architecture de l'application  :

L'architecture de notre application suit le modèle Modèle-Vue-Contrôleur (MVC) avec une couche supplémentaire pour le Repository Pattern.

Le Modèle-Vue-Contrôleur (MVC) est une architecture logicielle qui divise l'application en trois composants principaux :

- Modèle : Représente les données et la logique de l'application.
- Vue : Affiche les données au client.
- Contrôleur : Gère les entrées utilisateur et coordonne les interactions entre le modèle et la vue.

Le Repository Pattern ajoute une couche supplémentaire d'abstraction qui sépare la logique de stockage des données de la logique métier de l'application. Cette couche est responsable de l'accès aux données, de leur persistance et de leur récupération. Cette abstraction permet une meilleure maintenabilité et évolutivité de l'application.

En utilisant cette architecture, nous avons pu séparer les différentes responsabilités de l'application, ce qui facilite la maintenance et l'évolution de celle-ci.


![Architecture mvc](/soli-lms/pkg_suivi/branche-technique/images/mvc.png){:width="100%"}
*Figure 11:  Architecture de l'application*


## Prototype 

Avant de démarrer la réalisation de notre projet Soli-LMS, nous avons mis en place un prototype fonctionnel détaillé, développé sur trois sprints distincts :

- **Gestion des Projets (Sprint 1):**
Nous avons commencé par la création du sprint de gestion des projets, incluant les opérations CRUD de base pour la gestion des projets. Ces opérations couvrent la création, la lecture, la mise à jour et la suppression de projets, ainsi que leur association avec les utilisateurs et les tâches. Nous avons également intégré des fonctionnalités d’importation et d’exportation de données, permettant aux utilisateurs de manipuler facilement les données et d’effectuer des recherches dynamiques avec Ajax.

- **Gestion des Tâches (Sprint 2)**
Bien que prévu dans le planning, ce sprint n’a pas encore été réalisé. Il sera consacré à la gestion des tâches au sein des projets, comprenant la création, l’assignation, le suivi et la collaboration sur les différentes tâches.

- **Gestion de Stock (Sprint 3)**
Également en attente de réalisation, ce sprint se concentrera sur la gestion des stocks et des ressources matérielles nécessaires à la réalisation des projets. Cela inclura la gestion des stocks, des commandes, des entrées et sorties de matériel, ainsi que d’autres fonctionnalités liées à la gestion des ressources.

En parallèle, le prototype intègre un système d’authentification et d’autorisation utilisant Spatie pour assurer la sécurité et la gestion des droits d’accès des utilisateurs. Ce processus itératif nous a permis de valider rapidement les principales fonctionnalités de l’application, de recueillir des retours d’utilisateurs pour optimiser l’expérience utilisateur, et de garantir une transition fluide vers la phase de développement complète.