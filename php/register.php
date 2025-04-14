<?php
require 'db_connect.php' ;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $psswd = $_POST['mdp'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $groupe = $_POST['groupe'];
        $formation = $_POST['formation'];

        // Requête pour insérer le nouvel utilisateur
        $stmt = $pdo->prepare("INSERT INTO Users (username, psswd, Nom, Prenom ,Groupe, Formation) VALUES (?,?,?,?,?,?)");
        $stmt->execute([$username, $psswd, $nom, $prenom, $groupe, $formation]);

        echo "Compte créé avec succès !";

        $_SESSION["user_id"] = $pdo->lastInsertId();

        // Redirection vers registercar.php avec l'id_user en paramètre GET
        header("Location: registercar.html");

    }

?>