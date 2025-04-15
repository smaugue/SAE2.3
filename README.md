# SAE2.3
SAE2.3

| Étape / Fonctionnalité      | Fichier HTML           | Fichier PHP (traitement) | Autres fichiers liés     | Description rapide |
|----------------------------|------------------------|---------------------------|---------------------------|--------------------|
| 1. Création de compte      | `register.html`        | `register.php`            |                           | Formulaire de base pour créer un utilisateur |
| 2. Enregistrement véhicule | `registercar.html`     | `registercar.php`         |                           | Associe un véhicule à l’utilisateur |
| 3. Ajout de domicile       | `add_domicile.html`    | `add_domicile.php`        |                           | Ajoute un lieu et le lie comme domicile |
| 4. Création de trajet      | `add_course.html`      | `add_course.php`          | `get_lieux.php`           | Crée un trajet avec lieux sélectionnés |
| Menu de navigation         | `menu.php`            |                           |                           | Accès rapide à tous les formulaires |
| Chargement dynamique lieux |                        | `get_lieux.php`           | utilisé dans `add_course.html` | Fournit les lieux au menu déroulant |

