<?php

//on vérifie si l'utilisateur est connecté
//puis on se connecte à la base de données
require_once 'is_connected.php';
require_once 'db_connect.php';

header('Content-Type: application/json');

$user_id = $_SESSION['user_id'] ?? null;


//requete pour récupérer les courses disponibles
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

//on envoie la requete à la base de données
$stmt = $pdo->prepare($sql);
$stmt->execute();
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);


//de même, on récupère les courses de l'utilisateur dans la table Equipage
$sqlEquipage = "
    SELECT id_course
    FROM Equipage
    WHERE id_user = :user_id
";
$stmtEquipage = $pdo->prepare($sqlEquipage);
$stmtEquipage->execute(['user_id' => $user_id]);

$equipageCourses = $stmtEquipage->fetchAll(PDO::FETCH_COLUMN);
$equipageSet = array_flip($equipageCourses);

// Ajout des flags is_conducteur et is_member
foreach ($courses as &$course) {
    $course['is_conducteur'] = ($course['id_conducteur'] == $user_id);
    $course['is_member'] = isset($equipageSet[$course['id_course']]);
}

//on renvoie les courses au format JSON
echo json_encode($courses);
?>
