<?php
require_once 'is_connected.php';
require_once 'db_connect.php';

header('Content-Type: application/json');

$user_id = $_SESSION['user_id'] ?? null;

$sql = "
    SELECT
        c.id_course, 
        c.id_conducteur,
        c.DH_départ,
        c.DH_arrive,
        c.Nb_place_disponible,
        c.Prix,
        l1.Nom AS depart,
        l1.Ville AS ville_depart,
        l2.Nom AS arrivee,
        l2.Ville AS ville_arrivee
    FROM Course c
    JOIN Lieux l1 ON c.id_lieux_départ = l1.id_lieux
    JOIN Lieux l2 ON c.id_lieux_arrivé = l2.id_lieux
    WHERE c.Nb_place_disponible > 0
";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sqlEquipage = "
    SELECT id_course
    FROM Equipage
    WHERE id_user = :user_id
";
$stmtEquipage = $pdo->prepare($sqlEquipage);
$stmtEquipage->execute(['user_id' => $user_id]);

$equipageCourses = $stmtEquipage->fetchAll(PDO::FETCH_COLUMN);
$equipageSet = array_flip($equipageCourses); // Pour une recherche rapide

// Ajout des flags is_conducteur et is_member
foreach ($courses as &$course) {
    $course['is_conducteur'] = ($course['id_conducteur'] == $user_id);
    $course['is_member'] = isset($equipageSet[$course['id_course']]);
}

echo json_encode($courses);
?>
