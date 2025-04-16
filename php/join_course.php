<?php
header('Content-Type: application/json');

require_once 'is_connected.php';   // Définit $id_user
require_once 'db_connect.php';     // Donne accès à $pdo

$debug = []; // Pour stocker les infos de debug

$debug[] = "Début du script - utilisateur connecté : $id_user";

// Récupère l’ID de la course
$id_course = isset($_POST['id_course']) ? intval($_POST['id_course']) : 0;
$debug[] = "ID de course reçu : $id_course";

if ($id_course <= 0) {
    $debug[] = "ID de course invalide.";
    echo json_encode(['success' => false, 'message' => 'ID de course invalide.', 'debug' => $debug]);
    exit;
}

try {
    // Vérifie l’inscription existante
    $stmt = $pdo->prepare("SELECT 1 FROM Equipage WHERE id_course = ? AND id_user = ?");
    $stmt->execute([$id_course, $id_user]);
    if ($stmt->fetch()) {
        $debug[] = "Utilisateur déjà inscrit à cette course.";
        echo json_encode(['success' => false, 'message' => 'Vous êtes déjà inscrit à cette course.', 'debug' => $debug]);
        exit;
    }

    // Vérifie le nombre de places
    $stmt = $pdo->prepare("SELECT Nb_place_disponible FROM Course WHERE id_course = ?");
    $stmt->execute([$id_course]);
    $course = $stmt->fetch();

    if (!$course) {
        $debug[] = "Course introuvable en base.";
        echo json_encode(['success' => false, 'message' => 'Course introuvable.', 'debug' => $debug]);
        exit;
    }

    $debug[] = "Places disponibles : " . $course['Nb_place_disponible'];

    if ($course['Nb_place_disponible'] <= 0) {
        $debug[] = "Plus de places disponibles.";
        echo json_encode(['success' => false, 'message' => 'Aucune place disponible.', 'debug' => $debug]);
        exit;
    }

    // Ajoute l'utilisateur à l'équipage
    $pdo->prepare("INSERT INTO Equipage (id_course, id_user) VALUES (?, ?)")->execute([$id_course, $id_user]);
    $debug[] = "Inscription à l’équipage effectuée.";

    // Décrémente le nombre de places
    $pdo->prepare("UPDATE Course SET Nb_place_disponible = Nb_place_disponible - 1 WHERE id_course = ?")->execute([$id_course]);
    $debug[] = "Mise à jour du nombre de places effectuée.";

    echo json_encode(['success' => true, 'message' => 'Inscription réussie !', 'debug' => $debug]);

} catch (Exception $e) {
    $debug[] = "Exception attrapée : " . $e->getMessage();
    echo json_encode(['success' => false, 'message' => 'Erreur serveur.', 'debug' => $debug]);
}
