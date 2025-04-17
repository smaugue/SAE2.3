<?php
require 'is_admin.php';
require 'db_connect.php';

// Vérifie si un fichier a été envoyé
if (isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] === 0) {
    $file = $_FILES['csv_file']['tmp_name'];

    if (($handle = fopen($file, 'r')) !== FALSE) {
        $headers = fgetcsv($handle, 1000, ',');

        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
            $stmt = $pdo->prepare("INSERT INTO Users (username, psswd, Nom, Prenom, Groupe, EST_admin, Formation) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6]]);
        }

        fclose($handle);
        echo "Import terminé avec succès.";
    } else {
        echo "Impossible de lire le fichier.";
    }
} else {
    ?>
    <!DOCTYPE html>
    <html lang="fr">
        <head>

            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Admin</title>

            <!-- User connecté ? -->
            <script src="js/is_connected.js"></script>

            <!-- Préconnecter les sources de Google Fonts -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

            <!-- Police personnalisée -->
            <link href="https://fonts.googleapis.com/css2?family=Protest+Strike&family=Winky+Sans:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">

            <!-- css -->
            <link rel="stylesheet" href="accueil.css">
        </head>
        <body>

            <div class="wrapper">
                <div class="content">

                    <!-- Titre principal -->
                    <div class="logo">
                        <h1 class="protest-strike-regular">RouleMaPoule</h1>
                    </div>

                    <!-- Menu Burger -->
                    <div class="menu">
                        <div class="hamburger">&#9776;</div>
                        <nav>
                            <ul>
                                <li><a href="accueil.html">Accueil</a></li>
                                <li><a href="add_course.html">Programmer voyage</a></li>
                                <li><a href="join_course.html">Rechercher voyage</a></li>
                                <li><a href="registercar.html">Ajouter un véhicule</a></li>
                                <li><a href="propos.html">À propos</a></li>
                                <li><a href="contact.html">Contact</a></li>
                                <li><a href="php/logout.php">Se déconnecter</a></li>
                        </nav>
                    </div>

                    <?php

                        $user = $_SESSION['user'];
                        $user_id = $_SESSION['user_id'];

                        echo "<p>Connecté en temps que $user ($user_id)</p>";
                    ?>

                    <h2>Importer un fichier CSV</h2>
                    <form method="post" enctype="multipart/form-data">
                        <input type="file" name="csv_file" accept=".csv" required>
                        <br><br>
                        <button type="submit">Importer</button>
                    </form>

                </div>
            </div>

            <!-- Script JS -->
            <script src="accueil.js"></script>

        </body>
    </html>
<?php
}
?>