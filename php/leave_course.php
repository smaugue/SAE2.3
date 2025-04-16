<?php
require_once 'is_connected.php';
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
    // Vérifie si l'utilisateur est inscrit à la course
    $stmt = $pdo->prepare("SELECT 1 FROM Equipage WHERE id_course = ? AND id_user = ?");
    $stmt->execute([$id_course, $id_user]);

    if (!$stmt->fetch()) {
        echo json_encode(['success' => false, 'message' => 'Vous n\'êtes pas inscrit à cette course.']);
        exit;
    }

    // Désinscription de l'utilisateur
    $stmt = $pdo->prepare("DELETE FROM Equipage WHERE id_course = ? AND id_user = ?");
    $stmt->execute([$id_course, $id_user]);

    // Mise à jour du nombre de places disponibles
    $stmt = $pdo->prepare("UPDATE Course SET Nb_place_disponible = Nb_place_disponible + 1 WHERE id_course = ?");
    $stmt->execute([$id_course]);

    echo json_encode(['success' => true, 'message' => 'Vous avez quitté la course avec succès.']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Erreur serveur.']);
}
?>
