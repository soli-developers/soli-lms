---
layout: default
chapitre: true
package : pkg_suivi
order: 358
---

# Branche fonctionnelle
{:class="sectionHeader"}

<!-- note -->

Pendant cette phase de capture des besoins fonctionnels avec la méthode 2TUP, nous utilisons des outils tels que la carte d'empathie et la définition du problème, ainsi que des techniques d'idéation pour identifier les besoins des utilisateurs. De plus, nous faisons appel à l'UML, notamment les diagrammes de cas d'utilisation et les diagrammes de classe, pour formaliser et structurer ces besoins.



## Carte d'empathie de Formateur


![Carte empathie formateur : pkg_suivi](/soli-lms/Besoin/pkg_suivi/carte-empathie-formateur.svg)
*Figure 8: Carte d'empathie de formateur : pkg_suivi*

![Carte empathie apprenant : pkg_suivi](/soli-lms/Besoin/pkg_suivi/carte-empathie-apprenant.svg)
*Figure 9: Carte d'empathie d'apprenant : pkg_suivi*



### Définir le problème

## Problèmes Identifiés par les Formateurs
- **Absence de Critères Uniformes :** Les formateurs soulignent le besoin de critères d'évaluation standardisés pour garantir l'équité dans les retours et les évaluations des projets.
- **Outils de Gestion et de Communication Fragmentés :** Les formateurs utilisent divers outils (GitHub, Google Drive, Trello, Excel) qui ne sont pas toujours intégrés de manière efficace, compliquant la gestion des projets et la communication avec les apprenants.
- **Incohérence des Niveaux de Validation :** La diversité des niveaux de validation ("Basic", "Standard", "Premium", "Livecoding", etc.) entraîne de la confusion et un manque de cohérence dans l'évaluation des compétences des apprenants.
- **Manque de Visibilité sur l'Avancement des Apprenants :** Les formateurs disposent de peu d'outils efficaces pour identifier et suivre les apprenants en difficulté, ce qui limite la capacité à fournir un soutien adapté et ciblé.


### Idéation

#### Liste de Solutions Potentielles
**Application Web de Validation :**
Développer une application web dédiée à la validation des projets des apprenants.
Permettre aux formateurs d'évaluer chaque compétence ciblée dans un projet ou un brief.
Intégrer des niveaux de validation personnalisables (1, 2, 3 ou Basic, Standard, Premium).

**Système de Commentaires Détailés :**
Inclure des champs permettant aux formateurs d'ajouter des remarques et des commentaires détaillés.
Utiliser un format standard pour les commentaires afin d'assurer la cohérence et la clarté des retours.

**Tableau de Bord pour Formateurs :**
Créer un tableau de bord où les formateurs peuvent voir tous les projets en attente de validation.
Fournir des outils d'analyse pour suivre les performances des apprenants et l'efficacité des validations.
Intégrer une interface permettant de suivre l'état de validation des compétences.

**Notifications et Rappels :**
Mettre en place un système de notifications pour rappeler aux formateurs les validations en attente.
Informer les apprenants lorsque leurs projets ont été évalués.


## Diagamme de cas d'utilisation :

![Diagramme de cas d'utilisation: pkg_suivi ](/soli-lms/pkg_suivi/branche-fonctionnelle/images/uses_cases_pkg_suivi.png){:width="100%"}*Figure 10: Diagramme de cas d'utilisation: pkg_suivi*
