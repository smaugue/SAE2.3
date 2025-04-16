<?php
require 'is_connected.php';
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id_user = $_SESSION["user_id"];
    $ville = $_POST['ville'];
    $cp = $_POST['cp'];
    $rue = $_POST['rue'];
    $numero = $_POST['numero'];

    try {
        // Insérer un nouveau lieu de type "domicile"
        $stmt = $pdo->prepare("INSERT INTO Lieux (Ville, CP, Rue, Numéro, Type) VALUES (?, ?, ?, ?, 'home')");
        $stmt->execute([$ville, $cp, $rue, $numero]);

        // Récupérer l'ID du lieu inséré
        $id_lieux = $pdo->lastInsertId();

        // Lier ce lieu à l'utilisateur dans la table Habitation
        $stmtHab = $pdo->prepare("INSERT INTO Habitation (id_user, id_lieux) VALUES (?, ?)");
        $stmtHab->execute([$id_user, $id_lieux]);

        echo "Domicile ajouté avec succès !";

        header("Location: ../registercar.html");

    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout du domicile : " . $e->getMessage();
    }
}
?>
