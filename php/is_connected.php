<?php
session_start();
echo $_SESSION['user_id'];
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: ../login.html");
    exit();
}
?>