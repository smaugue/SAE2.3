<?php
session_start();
if ($_SESSION['admin'] != 1) {
    header("Location: logout.php");
    exit();
}
?>