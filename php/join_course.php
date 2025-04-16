<?php
session_start();
header('Content-Type: application/json');

require_once 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Utilisateur non connecté.']);
    exit;
}

$id_user = intval($_SESSION['user_id']);
$id_course = isset($_POST['id_course']) ? intval($_POST['id_course']) : 0;

if ($id_course <= 0) {
    echo json_encode(['success' => false, 'message' => 'ID de course invalide.']);
    exit;
}

try {
    // Récupère la course
    $stmt = $pdo->prepare("SELECT id_conducteur, Nb_place_disponible FROM Course WHERE id_course = ?");
    $stmt->execute([$id_course]);
    $course = $stmt->fetch();

    if (!$course) {
        echo json_encode(['success' => false, 'message' => 'Course introuvable.']);
        exit;
    }

    if ($course['id_conducteur'] == $id_user) {
        echo json_encode(['success' => false, 'message' => 'Vous êtes le conducteur de cette course.']);
        exit;
    }

    if ($course['Nb_place_disponible'] <= 0) {
        echo json_encode(['success' => false, 'message' => 'Aucune place disponible.']);
        exit;
    }

    // Vérifie si l'utilisateur est déjà inscrit
    $stmt = $pdo->prepare("SELECT 1 FROM Equipage WHERE id_course = ? AND id_user = ?");
    $stmt->execute([$id_course, $id_user]);
    if ($stmt->fetch()) {
        echo json_encode(['success' => false, 'message' => 'Vous êtes déjà inscrit à cette course.']);
        exit;
    }

    // Inscription dans Equipage
    $stmt = $pdo->prepare("INSERT INTO Equipage (id_course, id_user) VALUES (?, ?)");
    $stmt->execute([$id_course, $id_user]);

    // Mise à jour du nombre de places
    $stmt = $pdo->prepare("UPDATE Course SET Nb_place_disponible = Nb_place_disponible - 1 WHERE id_course = ?");
    $stmt->execute([$id_course]);

    echo json_encode(['success' => true, 'message' => 'Inscription réussie.']);

} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Erreur serveur.']);
}
