<?php
session_start();
if ($_SESSION['is_admin'] != 1) {
    header("Location: ../php/logout.php");
    exit();
}
?>