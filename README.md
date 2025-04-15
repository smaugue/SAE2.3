# SAE2.3

# Structure de la Base de Données

Ce tableau décrit les types de données et les valeurs possibles pour les variables de chaque table dans la base de données.

| **Table**           | **Colonne**             | **Type de données**            | **Valeurs possibles**                                 |
|---------------------|-------------------------|--------------------------------|-------------------------------------------------------|
| **Users**           | `id_user`               | `INT`                          | Valeur auto-incrémentée (Identifiant unique de l'utilisateur) |
|                     | `Nom`                   | `VARCHAR(50)`                  | Chaîne de caractères (Nom de l'utilisateur)          |
|                     | `Prénom`                | `VARCHAR(50)`                  | Chaîne de caractères (Prénom de l'utilisateur)       |
|                     | `Groupe`                | `VARCHAR(50)`                  | Chaîne de caractères (Nom du groupe de l'utilisateur) |
|                     | `Sous_groupe`           | `VARCHAR(50)`                  | Chaîne de caractères (Nom du sous-groupe de l'utilisateur) |
|                     | `Est_admin`             | `LOGICAL`                      | `TRUE`, `FALSE` (Indique si l'utilisateur est un administrateur) |
|                     | `id_vehicule`           | `INT`                          | Référence à `Vehicule.id_vehicule` (Identifiant du véhicule) |
|                     | `id_formation`          | `INT`                          | Référence à `Formation.id_formation` (Identifiant de la formation) |
|                     | `username`              | `VARCHAR(50)`                  | Chaîne de caractères (Nom d'utilisateur unique)      |
|                     | `password`              | `VARCHAR(50)`                  | Chaîne de caractères (Mot de passe crypté)            |
| **Vehicule**        | `id_vehicule`           | `INT`                          | Valeur auto-incrémentée (Identifiant unique du véhicule) |
|                     | `id_user`               | `INT`                          | Référence à `Users.id_user` (Identifiant de l'utilisateur) |
|                     | `Type`                  | `VARCHAR(50)`                  | 'Voiture', 'Moto', 'Camion' (exemples de types de véhicules) |
|                     | `Nb_place`              | `INT`                          | Nombre entier représentant le nombre de places       |
|                     | `Imatriculation`        | `VARCHAR(50)`                  | Chaîne de caractères (Numéro d'immatriculation du véhicule) |
|                     | `Controle_technique`    | `DATE`                         | Date au format 'YYYY-MM-DD' (Date de contrôle technique) |
|                     | `Assurance`             | `VARCHAR(50)`                  | Chaîne de caractères (Date ou informations sur l'assurance) |
| **Info_univ**       | `id_user`               | `INT`                          | Référence à `Users.id_user` (Identifiant de l'utilisateur) |
|                     | `deb_lundi`             | `TIME`                         | Heure au format 'HH:MM:SS' (Heure de début pour lundi) |
|                     | `deb_mardi`             | `TIME`                         | Heure au format 'HH:MM:SS' (Heure de début pour mardi) |
|                     | `deb_mercredi`          | `TIME`                         | Heure au format 'HH:MM:SS' (Heure de début pour mercredi) |
|                     | `deb_jeudi`             | `TIME`                         | Heure au format 'HH:MM:SS' (Heure de début pour jeudi) |
|                     | `deb_vendredi`          | `TIME`                         | Heure au format 'HH:MM:SS' (Heure de début pour vendredi) |
|                     | `deb_samedi`            | `TIME`                         | Heure au format 'HH:MM:SS' (Heure de début pour samedi) |
|                     | `fin_lundi`             | `TIME`                         | Heure au format 'HH:MM:SS' (Heure de fin pour lundi) |
|                     | `fin_mardi`             | `TIME`                         | Heure au format 'HH:MM:SS' (Heure de fin pour mardi) |
|                     | `fin_mercredi`          | `TIME`                         | Heure au format 'HH:MM:SS' (Heure de fin pour mercredi) |
|                     | `fin_jeudi`             | `TIME`                         | Heure au format 'HH:MM:SS' (Heure de fin pour jeudi) |
|                     | `fin_vendredi`          | `TIME`                         | Heure au format 'HH:MM:SS' (Heure de fin pour vendredi) |
|                     | `fin_samedi`            | `TIME`                         | Heure au format 'HH:MM:SS' (Heure de fin pour samedi) |
| **Course**          | `id_course`             | `INT`                          | Valeur auto-incrémentée (Identifiant unique du trajet) |
|                     | `id_conducteur`         | `INT`                          | Référence à `Users.id_user` (Identifiant du conducteur) |
|                     | `DH_départ`             | `DATETIME`                     | Date et heure de départ (format 'YYYY-MM-DD HH:MM:SS') |
|                     | `DH_arrive`             | `DATETIME`                     | Date et heure d'arrivée (format 'YYYY-MM-DD HH:MM:SS') |
|                     | `Place_dispo`           | `INT`                          | Nombre d'endroits disponibles dans le véhicule        |
|                     | `Nb_place_disponible`   | `INT`                          | Nombre total de places disponibles                    |
|                     | `Prix`                  | `INT`                          | Prix du trajet en unité monétaire (par exemple, en EUR) |
|                     | `id_lieux_départ`       | `INT`                          | Référence à `Lieux.id_lieux` (Identifiant du lieu de départ) |
|                     | `id_lieux_arrivé`       | `INT`                          | Référence à `Lieux.id_lieux` (Identifiant du lieu d'arrivée) |
| **Lieux**           | `id_lieux`              | `INT`                          | Valeur auto-incrémentée (Identifiant unique du lieu) |
|                     | `Nom`                   | `VARCHAR(50)`                  | Chaîne de caractères (Nom du lieu)                   |
|                     | `Ville`                 | `VARCHAR(50)`                  | Chaîne de caractères (Ville du lieu)                 |
|                     | `CP`                    | `INT`                          | Code postal du lieu                                   |
|                     | `Rue`                   | `VARCHAR(50)`                  | Chaîne de caractères (Rue du lieu)                   |
|                     | `Numéro`                | `INT`                          | Numéro de la rue ou du bâtiment                      |
|                     | `Type`                  | `VARCHAR(50)`                  | 'formation', 'loisirs', 'home'                       |
| **Equipage**        | `id_course`             | `INT`                          | Référence à `Course.id_course`                       |
|                     | `id_user`               | `INT`                          | Référence à `Users.id_user`                          |
| **Habitation**      | `id_user`               | `INT`                          | Référence à `Users.id_user`                          |
|                     | `id_lieux`              | `INT`                          | Référence à `Lieux.id_lieux`                          |

## Notes
- **`Users.Est_admin`** : Cette colonne utilise le type `LOGICAL`, avec les valeurs possibles `TRUE` ou `FALSE`, pour indiquer si l'utilisateur est un administrateur.
- **`Lieux.Type`** : Cette colonne peut avoir les valeurs suivantes :
  - `'formation'` : Lieu dédié à des formations ou des cours.
  - `'loisirs'` : Lieu dédié à des activités de loisirs.
  - `'home'` : Lieu privé ou à domicile.
  
- **Types de données** :
  - `INT` : Entier (utilisé pour les identifiants uniques et les valeurs numériques).
  - `VARCHAR(x)` : Chaîne de caractères, où `x` est la longueur maximale (en caractères).
  - `TIME` : Heure, au format `HH:MM:SS`.
  - `DATETIME` : Date et heure, au format `YYYY-MM-DD HH:MM:SS`.
  - `DATE` : Date, au format `YYYY-MM-DD`.
  - `LOGICAL` : Valeur logique, qui peut être `TRUE` ou `FALSE` (par exemple, pour `Est_admin`).


| Étape / Fonctionnalité      | Fichier HTML           | Fichier PHP (traitement) | Autres fichiers liés     | Description rapide |
|----------------------------|------------------------|---------------------------|---------------------------|--------------------|
| 1. Création de compte      | `register.html`        | `register.php`            |                           | Formulaire de base pour créer un utilisateur |
| 2. Enregistrement véhicule | `registercar.html`     | `registercar.php`         |                           | Associe un véhicule à l’utilisateur |
| 3. Ajout de domicile       | `add_domicile.html`    | `add_domicile.php`        |                           | Ajoute un lieu et le lie comme domicile |
| 4. Création de trajet      | `add_course.html`      | `add_course.php`          | `get_lieux.php`           | Crée un trajet avec lieux sélectionnés |
| Menu de navigation         | `menu.php`            |                           |                           | Accès rapide à tous les formulaires |
| Chargement dynamique lieux |                        | `get_lieux.php`           | utilisé dans `add_course.html` | Fournit les lieux au menu déroulant |

