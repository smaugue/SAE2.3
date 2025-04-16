<?php
require 'is_connected.php';
require 'db_connect.php';

header('Content-Type: application/json');
session_start();

$id_user = $_SESSION['user_id'];

$input = json_decode(file_get_contents("php://input"), true);
$id_course = $input['id_course'] ?? null;

if (!$id_course) {
    echo json_encode(["success" => false, "message" => "ID de course manquant."]);
    exit;
}

// Vérifier si déjà inscrit
$check = $pdo->prepare("SELECT * FROM Equipage WHERE id_user = ? AND id_course = ?");
$check->execute([$id_user, $id_course]);

if ($check->rowCount() > 0) {
    echo json_encode(["success" => false, "message" => "Vous êtes déjà inscrit à cette course."]);
    exit;
}

// Vérifier qu’il reste des places
$checkPlace = $pdo->prepare("SELECT Nb_place_disponible FROM Course WHERE id_course = ?");
$checkPlace->execute([$id_course]);
$course = $checkPlace->fetch(PDO::FETCH_ASSOC);

if (!$course || $course['Nb_place_disponible'] <= 0) {
    echo json_encode(["success" => false, "message" => "Plus de places disponibles."]);
    exit;
}

// Inscription
$insert = $pdo->prepare("INSERT INTO Equipage (id_course, id_user) VALUES (?, ?)");
$insert->execute([$id_course, $id_user]);

// MAJ places
$update = $pdo->prepare("UPDATE Course SET Nb_place_disponible = Nb_place_disponible - 1 WHERE id_course = ?");
$update->execute([$id_course]);

echo json_encode(["success" => true, "message" => "Inscription réussie !"]);
