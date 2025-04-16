<?php
session_start();
if ($_SESSION['is_admin'] != TRUE) {
    header("Location: php/logout.php");
    exit();
}
?>