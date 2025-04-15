<?php
require 'is_connected.php';
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id_user = $_SESSION["user_id"];
    $type = $_POST['type'];
    $nb_place = $_POST['nb_place'];
    $imatriculation = $_POST['imatriculation'];
    $controle_technique = $_POST['controle_technique']; // Format YYYY-MM-DD
    $assurance = $_POST['assurance'];

    try {
        // Insertion du véhicule
        $stmt = $pdo->prepare("INSERT INTO Vehicule (Type, Nb_place, Imatriculation, Controle_technique, Assurance) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$type, $nb_place, $imatriculation, $controle_technique, $assurance]);

        // Récupération de l'id du véhicule
        $id_vehicule = $pdo->lastInsertId();

        // Mise à jour de l'utilisateur avec l'id du véhicule
        $stmtUpdate = $pdo->prepare("UPDATE Users SET id_vehicule = ? WHERE id_user = ?");
        $stmtUpdate->execute([$id_vehicule, $id_user]);

        echo "Véhicule enregistré avec succès !";

        header("Location: ../accueil.html");

    } catch (PDOException $e) {
        echo "Erreur lors de l'enregistrement du véhicule : " . $e->getMessage();
    }
}
?>
