<?php
require_once 'is_connected.php';
require_once 'db_connect.php';
header('Content-Type: application/json');

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    echo json_encode(['error' => 'Utilisateur non connecté']);
    exit;
}

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
        c.id_conducteur,
        (c.id_conducteur = :user_id) AS is_conducteur,
        EXISTS (
            SELECT 1 FROM Equipage e 
            WHERE e.id_course = c.id_course AND e.id_user = :user_id
        ) AS is_inscrit
    FROM Course c
    JOIN Lieux l1 ON c.id_lieux_départ = l1.id_lieux
    JOIN Lieux l2 ON c.id_lieux_arrivé = l2.id_lieux
    WHERE 
        c.Nb_place_disponible > 0 
        OR c.id_conducteur = :user_id
        OR EXISTS (
            SELECT 1 FROM Equipage e 
            WHERE e.id_course = c.id_course AND e.id_user = :user_id
        )
    ORDER BY c.DH_départ ASC
";

$stmt = $pdo->prepare($sql);
$stmt->execute(['user_id' => $user_id]);
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($courses);
