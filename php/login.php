<?php
session_start();
require 'db_connect.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM Users WHERE username = :username";
$stmt = $pdo->prepare($sql);
$stmt->execute(['username' => $username]);
$user = $stmt->fetch();

if ($user && $password === $user['psswd']) {
    $_SESSION['user'] = $user['username'];
    $_SESSION['user_id'] = $user['id_user']; // Ajout demandé
    header("Location: accueil.html");
    exit();
} else {
    echo "Identifiants incorrects.";
}
?>
