<?php
header('Content-Type: application/json');

require 'is_connected.php'; // Vérifier que l'utilisateur est connecté
require 'db_connect.php'; // Connexion à la base de données

$id_user = $_SESSION['id_user'];

// Vérifier que l'id_course est bien envoyé
if (!isset($_POST['id_course'])) {
    echo json_encode(['success' => false, 'message' => 'ID de course manquant.']);
    exit;
}

$id_course = intval($_POST['id_course']);

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifier si l'utilisateur est déjà inscrit
    $stmt = $pdo->prepare("SELECT * FROM Equipage WHERE id_course = ? AND id_user = ?");
    $stmt->execute([$id_course, $id_user]);
    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => false, 'message' => 'Vous êtes déjà inscrit à cette course.']);
        exit;
    }

    // Vérifier s’il reste des places
    $stmt = $pdo->prepare("SELECT Nb_place_disponible FROM Course WHERE id_course = ?");
    $stmt->execute([$id_course]);
    $course = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$course) {
        echo json_encode(['success' => false, 'message' => 'Course introuvable.']);
        exit;
    }

    if ($course['Nb_place_disponible'] <= 0) {
        echo json_encode(['success' => false, 'message' => 'Plus de places disponibles.']);
        exit;
    }

    // Ajouter l'utilisateur à la course
    $stmt = $pdo->prepare("INSERT INTO Equipage (id_course, id_user) VALUES (?, ?)");
    $stmt->execute([$id_course, $id_user]);

    // Diminuer le nombre de places disponibles
    $stmt = $pdo->prepare("UPDATE Course SET Nb_place_disponible = Nb_place_disponible - 1 WHERE id_course = ?");
    $stmt->execute([$id_course]);

    echo json_encode(['success' => true]);

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Erreur serveur : ' . $e->getMessage()]);
}
