<?php
$host = 'mysql_serv';
$dbname = 'tvermot_05';
$user = 'tvermot'; // Votre nom d'utilisateur mysql.
$password = 'Admintvermot25'; // Votre mot de passe mysql
$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Échec de la connexion : " . mysqli_connect_error());
}
echo "Connexion réussie !";
?>