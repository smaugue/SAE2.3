<?php
session_start();
if (!$_SESSION['is_admin']) {
    header("Location: php/logout.php");
    exit();
}
?>