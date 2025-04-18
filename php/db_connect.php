<?php
$host = 'mysql_serv';
$dbname = 'tvermot_05';
$user = 'tvermot';
$password = 'Admintvermot25';
$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Échec de la connexion : " . mysqli_connect_error());
}
//echo "Connexion réussie !";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}


?>