<?php
session_start();
// Check if the user is connected
if (!isset($_SESSION['user_id'])) {
    // Redirect to login.html if not connected
    header('Location: /login.html');
    exit();
}
echo "mdr";

// User is connected, continue with the rest of the script
?>