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
    header("Location: accueil.php");
    exit();
} else {
    echo "Identifiants incorrects.";
}
?>