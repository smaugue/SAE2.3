<?php
session_start();
// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: ../accueil.html");
    exit();
}

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
    if ($user['Est_admin'] == 1) {
        $_SESSION['is_admin'] = true;
    } else {
        $_SESSION['is_admin'] = false;
    }
    header("Location: ../accueil.html");
    exit();
} else {
    header("Location: ../index.html");
}
?>
