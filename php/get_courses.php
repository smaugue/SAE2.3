<?php
require 'is_connected.php';  // Vérification si l'utilisateur est connecté
require 'db_connect.php';  // Connexion à la base de données

header('Content-Type: application/json');

// Vérification si l'utilisateur est bien connecté
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Vous devez être connecté']);
    exit;
}

$id_user = $_SESSION['user_id'];  // ID de l'utilisateur connecté

$sql = "
    SELECT 
        c.id_course,
        c.DH_départ,
        c.DH_arrive,
        c.Nb_place_disponible,
        l1.Nom AS depart,
        l1.Ville AS ville_depart,
        l2.Nom AS arrivee,
        l2.Ville AS ville_arrivee,
        CASE 
            WHEN e.id_user IS NOT NULL THEN 1
            ELSE 0
        END AS is_registered
    FROM Course c
    JOIN Lieux l1 ON c.id_lieux_départ = l1.id_lieux
    JOIN Lieux l2 ON c.id_lieux_arrivé = l2.id_lieux
    LEFT JOIN Equipage e ON c.id_course = e.id_course AND e.id_user = :id_user
    WHERE c.Nb_place_disponible > 0
";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id_user' => $id_user]);
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($courses);
?>
