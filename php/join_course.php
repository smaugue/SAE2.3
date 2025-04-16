<?php
header('Content-Type: application/json');

require_once 'is_connected.php';   // Définit $id_user si l'utilisateur est connecté
require_once 'db_connect.php';     // Donne accès à $pdo (connexion à la base)

$id_course = isset($_POST['id_course']) ? intval($_POST['id_course']) : 0;
if ($id_course <= 0) {
    echo json_encode(['success' => false, 'message' => 'ID de course invalide.']);
    exit;
}

// Vérifie que l'utilisateur n’est pas déjà inscrit
$stmt = $pdo->prepare("SELECT 1 FROM Equipage WHERE id_course = ? AND id_user = ?");
$stmt->execute([$id_course, $id_user]);
if ($stmt->fetch()) {
    echo json_encode(['success' => false, 'message' => 'Vous êtes déjà inscrit à cette course.']);
    exit;
}

// Vérifie qu’il reste des places
$stmt = $pdo->prepare("SELECT Nb_place_disponible FROM Course WHERE id_course = ?");
$stmt->execute([$id_course]);
$course = $stmt->fetch();

if (!$course) {
    echo json_encode(['success' => false, 'message' => 'Course introuvable.']);
    exit;
}

if ($course['Nb_place_disponible'] <= 0) {
    echo json_encode(['success' => false, 'message' => 'Aucune place disponible.']);
    exit;
}

// Inscription
$stmt = $pdo->prepare("INSERT INTO Equipage (id_course, id_user) VALUES (?, ?)");
$stmt->execute([$id_course, $id_user]);

// Mise à jour du nombre de places
$stmt = $pdo->prepare("UPDATE Course SET Nb_place_disponible = Nb_place_disponible - 1 WHERE id_course = ?");
$stmt->execute([$id_course]);

echo json_encode(['success' => true, 'message' => 'Inscription réussie !']);
