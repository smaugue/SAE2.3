<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>login</title>
</head>
<body>


<form action="register.php" method="POST">
    <label>Nom d'utilisateur</label><br>
    <input type="text" name="username" required><br>
    
    <label>Mot de passe:</label><br>
    <input type="text" name="mdp" required><br><br>
    
    <label>Nom:</label><br>
    <input type="text" name="nom" required><br><br>

    <label>Prenom:</label><br>
    <input type="text" name="prenom" required><br><br>

    <label>Votre Groupe ?</label><br>
    <input type="text" name="groupe" required><br><br>

    <label>Votre Foramation ?</label><br>
    <input type="text" name="formation" required><br><br>


    <input type="submit" value="Créer un compte">
</form>

<?php
require 'db_connect.php' ;
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $psswd = $_POST['mdp'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $groupe = $_POST['groupe'];
        $formation = $_POST['formation'];

        // Requête pour insérer le nouvel utilisateur
        $stmt = $pdo->prepare("INSERT INTO Users (username, psswd, Nom, Prenom ,Groupe, Formation) VALUES (?,?,?,?,?,?)");
        $stmt->execute([$username, $psswd, $nom, $prenom, $groupe, $formation]);

        echo "Compte créé avec succès !";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>




    
</body>
</html>