# SAE2.3

# Structure du site

## 📌 Fonctionnalités principales

| Étape / Fonctionnalité         | Terminé | Fichier HTML             | Fichiers PHP liés                                                        | Autres fichiers liés            | Description rapide |
|--------------------------------|---------|--------------------------|---------------------------------------------------------------------------|-----------------------------------------------|--------------------|
| 1. Création de compte          | ✅ Oui  | `register.html`          | `register.php`                                                            | `accueil.js`, `accueil.css`    | Formulaire de création d’un compte utilisateur |
| 1'. Connexion / Déconnexion    | ✅ Oui  | `index.html`             | `login.php`, `logout.php`                                                | `accueil.js`, `accueil.css`     | Connexion et déconnexion d’un utilisateur |
| 2. Ajout de domicile           | ✅ Oui  | `add_domicile.html`      | `add_domicile.php`                                                       | `accueil.js`, `accueil.css`     | Ajoute un lieu comme domicile de l’utilisateur |
| 3. Enregistrement véhicule     | ✅ Oui  | `registercar.html`       | `registercar.php`                                                        | `accueil.js`, `accueil.css`     | Associe un véhicule à un utilisateur |
| 4. Création de trajet          | ✅ Oui  | `add_course.html`        | `add_course.php`, `get_lieux.php`                                        | `accueil.js`, `accueil.css`     | Crée un trajet en sélectionnant les lieux |
| 5. Gestion des trajets         | ✅ Oui  | `join_course.html`       | `join_course.php`, `leave_course.php`, `delete_course.php`, `get_course.php` | `accueil.js`, `accueil.css` | Rejoindre, quitter, ou supprimer un trajet |
| 6. Accueil                     | ✅ Oui  | `accueil.html`           | `get_course.php`                                                          | `accueil.js`, `accueil.css`     | Page principale avec liste filtrée des trajets |
| À propos du site               | ✅ Oui  | `propos.html`            |                                                                           | `accueil.js`, `accueil.css`    | Présentation du projet |
| Page de contact                | ✅ Oui  | `contact.html`           |                                                                           | `accueil.js`, `accueil.css`    | Informations ou formulaire de contact |
| Page administrateur            | ✅ Oui  | `menu.php`               | `import_user.php`, `is_admin.php`                                        | `accueil.js`, `accueil.css`     | Importation d'utilisateurs via CSV (admin) |
| Chargement dynamique des lieux | ✅ Oui  | *(via `add_course.html`)*| `get_lieux.php`                                                           | `accueil.js`                   | Fournit les lieux dans les menus déroulants |
| Chargement dynamique des trajets | ✅ Oui | *(via `join_course.html`, `accueil.html`)* | `get_course.php`                                 | `accueil.js`                         | Met à jour les trajets affichés pour l’utilisateur |

---

## 🗂️ Arborescence du site

/                  # Racine du projet
│
├── accueil.html
├── add_course.html
├── add_domicile.html
├── contact.html
├── index.html
├── join_course.html
├── propos.html
├── register.html
├── registercar.html
│
├── css/
│   └── accueil.css                # Feuille de style principale
│
├── js/
│   └── accueil.js                # Script JS global (inclus partout)
│
├── php/
│   ├── add_course.php
│   ├── add_domicile.php
│   ├── db_connect.php
│   ├── delete_course.php
│   ├── get_course.php
│   ├── get_lieux.php
│   ├── import_user.php
│   ├── is_admin.php
│   ├── is_connected.php
│   ├── join_course.php
│   ├── leave_course.php
│   ├── login.php
│   ├── logout.php
│   ├── register.php
│   └── registercar.php


# Structure de la Base de Données

Ce tableau décrit les types de données et les valeurs possibles pour les variables de chaque table dans la base de données.

| **Table**           | **Colonne**             | **Type de données**            | **Valeurs possibles**                                 |
|---------------------|-------------------------|--------------------------------|-------------------------------------------------------|
| **Users**           | `id_user`               | `INT`                          | Valeur auto-incrémentée (Identifiant unique de l'utilisateur) |
|                     | `Nom`                   | `VARCHAR(50)`                  | Chaîne de caractères (Nom de l'utilisateur)          |
|                     | `Prénom`                | `VARCHAR(50)`                  | Chaîne de caractères (Prénom de l'utilisateur)       |
|                     | `Groupe`                | `VARCHAR(50)`                  | Chaîne de caractères (Nom du groupe de l'utilisateur) |
|                     | `Sous_groupe`           | `VARCHAR(50)`                  | Chaîne de caractères (Nom du sous-groupe de l'utilisateur) |
|                     | `Est_admin`             | `BOOL`                         | `TRUE`, `FALSE` (Indique si l'utilisateur est un administrateur) |
|                     | `id_vehicule`           | `INT`                          | Référence à `Vehicule.id_vehicule` (Identifiant du véhicule) |
|                     | `username`              | `VARCHAR(50)`                  | Chaîne de caractères (Nom d'utilisateur unique)      |
|                     | `password`              | `VARCHAR(50)`                  | Chaîne de caractères (Mot de passe)            |
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