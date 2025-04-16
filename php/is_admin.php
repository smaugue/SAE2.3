<?php
session_start();
echo("test");
echo($_SESSION['is_admin']);
echo("test2");
if ($_SESSION['is_admin'] != TRUE) {
    echo "Vous n'avez pas accès à cette page.";
    //header("Location: php/logout.php");
    //exit();
}
?>