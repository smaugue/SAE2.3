<?php
require 'db_connect.php';

header('Content-Type: application/json');

try {
    $stmt = $pdo->query("SELECT id_lieux, Nom, Ville, Type FROM Lieux");
    $lieux = $stmt->fetchAll(PDO::FETCH_ASSOC); //i wana cry help me plz
    //la on renvoi le tableau de lieux en json (pcq c le plus simple avec le js derrière)
    echo json_encode($lieux);
} catch (PDOException $e) {
    echo json_encode([]);
}
?>