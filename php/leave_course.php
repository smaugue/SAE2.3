<?php
require 'is_connected.php';  // Vérification si l'utilisateur est connecté
require 'db_connect.php';  // Connexion à la base de données

header('Content-Type: application/json');

// Vérification si l'utilisateur est bien connecté
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Vous devez être connecté']);
    exit;
}

$id_user = $_SESSION['user_id'];  // Récupérer l'ID de l'utilisateur connecté
$id_course = $_POST['id_course'];  // ID de la course reçue par POST

// Vérifier si l'utilisateur est inscrit à cette course
$sql_check = "SELECT * FROM Equipage WHERE id_user = :id_user AND id_course = :id_course";
$stmt_check = $pdo->prepare($sql_check);
$stmt_check->execute(['id_user' => $id_user, 'id_course' => $id_course]);

if ($stmt_check->rowCount() == 0) {
    echo json_encode(['success' => false, 'message' => 'Vous n\'êtes pas inscrit à cette course']);
    exit;
}

// Supprimer l'inscription de l'utilisateur à la course
$sql = "DELETE FROM Equipage WHERE id_course = :id_course AND id_user = :id_user";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id_course' => $id_course, 'id_user' => $id_user]);

// Mettre à jour le nombre de places disponibles
$sql_update = "UPDATE Course SET Nb_place_disponible = Nb_place_disponible + 1 WHERE id_course = :id_course";
$stmt_update = $pdo->prepare($sql_update);
$stmt_update->execute(['id_course' => $id_course]);

echo json_encode(['success' => true, 'message' => 'Vous avez quitté la course.']);
?>
