<?php
require 'is_connected.php';
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id_user = $_SESSION["user_id"];
    $depart = $_POST['depart'];
    $arrivee = $_POST['arrivee'];
    $dh_depart = $_POST['dh_depart'];
    $dh_arrivee = $_POST['dh_arrivee'];
    $prix = $_POST['prix'];

    try {
        // Récupérer l'id_vehicule de l'utilisateur
        $stmtVeh = $pdo->prepare("SELECT id_vehicule FROM Users WHERE id_user = ?");
        $stmtVeh->execute([$id_user]);
        $id_vehicule = $stmtVeh->fetchColumn();

        if (!$id_vehicule) {
            echo "Erreur : aucun véhicule associé à cet utilisateur.";
            exit;
        }

        // Récupérer le nombre de places du véhicule
        $stmtPlaces = $pdo->prepare("SELECT Nb_place FROM Vehicule WHERE id_vehicule = ?");
        $stmtPlaces->execute([$id_vehicule]);
        $nb_place = $stmtPlaces->fetchColumn();

        if (!$nb_place) {
            echo "Erreur : véhicule non trouvé ou nombre de places invalide.";
            exit;
        }

        // Insérer la course
        $stmtCourse = $pdo->prepare("INSERT INTO Course (id_conducteur, DH_départ, DH_arrive, Place_dispo, Nb_place_disponible, Prix, id_lieux_départ, id_lieux_arrivé) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmtCourse->execute([$id_user, $dh_depart, $dh_arrivee, $nb_place, $nb_place, $prix, $depart, $arrivee]);

        echo "Trajet créé avec succès !";

    } catch (PDOException $e) {
        echo "Erreur lors de la création du trajet : " . $e->getMessage();
    }
}
?>
