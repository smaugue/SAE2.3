<?php
require 'is_connected.php';
require 'db_connect.php';
header('Content-Type: application/json');

$input = json_decode(file_get_contents("php://input"), true);

$ville = isset($input['ville']) ? trim($input['ville']) : '';
$jour = isset($input['jour']) ? intval($input['jour']) : null;

$where = "WHERE c.Nb_place_disponible > 0";
$params = [];

// Filtre ville
if (!empty($ville)) {
    $where .= " AND l1.Ville LIKE ?";
    $params[] = "%$ville%";
}

// Filtre jour
if ($jour !== null && $jour !== '') {
    $where .= " AND DAYOFWEEK(c.DH_départ) = ?";
    $jour_mysql = ($jour == 0) ? 1 : $jour + 1;
    $params[] = $jour_mysql;
}

$sql = "
    SELECT c.id_course, c.DH_départ, c.DH_arrive, c.Nb_place_disponible, 
           l1.Nom AS depart, l2.Nom AS arrivee
    FROM Course c
    JOIN Lieux l1 ON c.id_lieux_départ = l1.id_lieux
    JOIN Lieux l2 ON c.id_lieux_arrivé = l2.id_lieux
    $where
    ORDER BY c.DH_départ ASC
";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($courses);
