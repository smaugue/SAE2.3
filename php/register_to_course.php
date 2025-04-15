<?php
// Include database connection
require_once 'db_connection.php';

session_start();

// Check if user is logged in
require 'is_connected.php';

// Check if course_id is provided
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['course_id'])) {
    $user_id = $_SESSION['user_id'];
    $course_id = intval($_POST['course_id']);

    // Check if the user is already registered for the course
    $checkQuery = $db->prepare('SELECT * FROM Equipage WHERE id_user = ? AND id_course = ?');
    $checkQuery->execute([$user_id, $course_id]);

    if ($checkQuery->rowCount() > 0) {
        echo "Vous êtes déjà inscrit à cette course.";
    } else {
        // Register the user to the course
        $insertQuery = $db->prepare('INSERT INTO Equipage (id_user, id_course) VALUES (?, ?)');
        if ($insertQuery->execute([$user_id, $course_id])) {
            echo "Inscription à la course réussie.";
        } else {
            echo "Erreur lors de l'inscription à la course.";
        }
    }
} else {
    echo "Aucunne course sélectionnée.";
}
?>