---
layout: default
chapitre: true
package : pkg_formations
order: 350
---
## Branche fonctionnelle 
{:class="sectionHeader"}

<!-- note -->

Dans cette phase de capture des besoins fonctionnels de notre plateforme de gestion des formations, nous utilisons une approche centrée sur l'utilisateur. En nous appuyant sur des outils tels que la carte d'empathie et la définition du problème, ainsi que sur des techniques d'idéation, nous identifions les besoins spécifiques des formateurs. La modélisation UML, à travers des diagrammes de cas d'utilisation et de classes, vient ensuite formaliser et structurer ces besoins.


##  Comprendre les besoins du formateur 

![Carte empathie : plateforme d'apprentissage](/soli-lms/Besoin/pkg_formations/Carte-empathie.svg)
*Carte d'empathie formateur : plateforme d'apprentissage*

### Identifier les points critiques

## Problématiques rencontrées par les formateurs

- **Manque d'harmonisation des critères d'évaluation :**  Les formateurs soulignent la nécessité de critères clairs et uniformes pour garantir une évaluation objective et équitable des apprenants.
- **Dispersion des outils de suivi et de communication :** L'utilisation d'outils disparates (GitHub, Google Drive, Trello, Excel) complexifie la gestion des formations et la communication avec les apprenants.
- **Incohérence des niveaux de validation :**  La multitude de niveaux de validation ("Basic", "Standard", "Premium", "Livecoding", etc.) engendre confusion et manque de cohérence dans l'évaluation des compétences.
- **Difficulté à identifier les apprenants en difficulté :** Les formateurs manquent d'outils performants pour détecter rapidement les apprenants en besoin de soutien et suivre leur progression.

## Enjeu central 

- Comment concevoir une plateforme intégrée qui offre aux formateurs les outils nécessaires pour évaluer efficacement les apprenants, fournir un feedback pertinent et accompagner individuellement leur progression ?

## Analyse et solutions potentielles

###  Explorer les solutions

#### Pistes d'amélioration 

**Module de validation intégré à la plateforme :**
- Développer un module dédié à la validation des projets au sein même de la plateforme.
- Permettre aux formateurs d'évaluer chaque compétence ciblée par le projet.
- Offrir la possibilité de personnaliser les niveaux de validation (1, 2, 3 ou Basic, Standard, Premium) tout en assurant une certaine cohérence.

**Système de feedback structuré et détaillé :**
- Intégrer des champs dédiés à la rédaction de commentaires précis et constructif.
- Proposer un format standardisé pour les commentaires afin de garantir clarté et cohérence.

**Tableau de bord dédié aux formateurs :**
- Créer un tableau de bord centralisant les informations essentielles : projets en attente de validation, suivi des apprenants, statistiques de performance.
- Fournir des outils d'analyse permettant d'évaluer l'efficacité des validations et de suivre la progression globale des apprenants.

**Système de notifications et de rappels intégré :**
- Mettre en place des notifications pour informer les formateurs des validations en attente et les apprenants de l'évaluation de leurs projets.
-  Permettre la programmation de rappels pour les échéances importantes.


## Modélisation des interactions

### Diagramme de cas d'utilisation :
![Diagamme de cas d'utilisation : plateforme d'apprentissage ](/soli-lms/diagrammes/pkg_formations/uses_cases_pkg_formations/uses_cases_pkg_creation_projets.svg){:width="600%"}
*Diagamme de cas d'utilisation : plateforme d'apprentissage *

