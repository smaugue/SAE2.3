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
    // Récupère la course
    $stmt = $pdo->prepare("SELECT id_conducteur FROM Course WHERE id_course = ?");
    $stmt->execute([$id_course]);
    $course = $stmt->fetch();

    if (!$course) {
        echo json_encode(['success' => false, 'message' => 'Course introuvable.']);
        exit;
    }

    if ($course['id_conducteur'] != $id_user) {
        echo json_encode(['success' => false, 'message' => 'Vous devez être le conducteur pour supprimer cette course.']);
        exit;
    }

    // Supprime les inscriptions
    $stmt = $pdo->prepare("DELETE FROM Equipage WHERE id_course = ?");
    $stmt->execute([$id_course]);

    // Supprime la course
    $stmt = $pdo->prepare("DELETE FROM Course WHERE id_course = ?");
    $stmt->execute([$id_course]);

    echo json_encode(['success' => true, 'message' => 'Course supprimée avec succès.']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Erreur serveur.']);
}
?>
