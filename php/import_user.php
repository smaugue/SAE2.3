<?php
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
        <title>Import CSV Utilisateurs</title>
    </head>
    <body>
        <h2>Importer un fichier CSV</h2>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="csv_file" accept=".csv" required>
            <br><br>
            <button type="submit">Importer</button>
        </form>
    </body>
    </html>
    <?php
}
?>