<?php
require 'is_connected.php';
require 'db_connect.php';

header('Content-Type: application/json');

$sql = "
    SELECT c.id_course, c.DH_départ, c.DH_arrive, c.Nb_place_disponible, 
           l1.Nom AS depart, l2.Nom AS arrivee
    FROM Course c
    JOIN Lieux l1 ON c.id_lieux_départ = l1.id_lieux
    JOIN Lieux l2 ON c.id_lieux_arrivé = l2.id_lieux
    WHERE c.Nb_place_disponible > 0
";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($courses);
