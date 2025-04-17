<!DOCTYPE html>
<html lang="fr">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Site Web</title>

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
                        <li><a href="#">Accueil</a></li>
                        <li><a href="#">À propos</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="page1.php">Programmer voyage</a></li>
                        <li><a href="page2.php">Rechercher voyage</a></li>
                    </ul>
                </nav>
            </div>

            <?php
                require_once 'php/import_user.php';
            ?>

        </div>
    </div>

    <!-- Script JS -->
    <script src="accueil.js"></script>

</body>
</html>