<?php
require 'is_connected.php'; // Vérifie la session
require 'db_connect.php';   // Connexion à la base de données
session_start();

header('Content-Type: application/json');  // En-tête pour indiquer que la réponse sera en JSON

// Afficher les erreurs PHP pour le débogage
ini_set('display_errors', 1);
error_reporting(E_ALL);

$id_user = $_SESSION['user_id'];  // L'ID de l'utilisateur depuis la session
$input = $_POST;  // On récupère les données envoyées via POST
$id_course = $input['id_course'] ?? null;  // Récupération de l'ID de la course

// Vérification si l'ID de la course est valide
if (!$id_course) {
    echo json_encode(["success" => false, "message" => "ID de course manquant."]);
    exit;
}

// Vérifier si déjà inscrit à la course
$check = $pdo->prepare("SELECT * FROM Equipage WHERE id_user = ? AND id_course = ?");
$check->execute([$id_user, $id_course]);

if ($check->rowCount() > 0) {
    echo json_encode(["success" => false, "message" => "Vous êtes déjà inscrit à cette course."]);
    exit;
}

// Vérifier la disponibilité des places
$checkPlace = $pdo->prepare("SELECT Nb_place_disponible FROM Course WHERE id_course = ?");
$checkPlace->execute([$id_course]);
$course = $checkPlace->fetch(PDO::FETCH_ASSOC);

if (!$course || $course['Nb_place_disponible'] <= 0) {
    echo json_encode(["success" => false, "message" => "Plus de places disponibles."]);
    exit;
}

// Ajouter l'utilisateur dans la table Equipage
$insert = $pdo->prepare("INSERT INTO Equipage (id_course, id_user) VALUES (?, ?)");
$insert->execute([$id_course, $id_user]);

// Décrémenter le nombre de places disponibles
$update = $pdo->prepare("UPDATE Course SET Nb_place_disponible = Nb_place_disponible - 1 WHERE id_course = ?");
$update->execute([$id_course]);

// Réponse JSON valide
echo json_encode(["success" => true, "message" => "Inscription réussie à la course."]);
?>
