<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Menu de Navigation</title>
</head>
<body>
    <h1>Menu de Développement</h1>

    <ul>
        <li><a href="register.html">1. Créer un compte utilisateur</a></li>
        <li><a href="registercar.html">2. Enregistrer un véhicule</a></li>
        <li><a href="add_domicile.html">3. Ajouter un domicile</a></li>
        <li><a href="add_course.html">4. Créer un trajet</a></li>
    </ul>

    <p>Need la coe d'un user pour 2 à 4</p>
    <?php
        session_start();
        if (isset($_SESSION["user_id"])) {
            echo "Utilisateur connecté : " . $_SESSION["user_id"];
        } else {
            echo "Aucun utilisateur connecté.";
        }
    ?>

</body>
</html>
