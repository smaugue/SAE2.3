<?php
session_start();
echo($_SESSION['is_admin']);
if ($_SESSION['is_admin'] != TRUE) {
    echo "Vous n'avez pas accès à cette page.";
    //header("Location: php/logout.php");
    //exit();
}
?>