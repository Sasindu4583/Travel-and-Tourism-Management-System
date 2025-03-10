<?php
session_start(); // Start a session to manage user login state

// Destroy session to log out the user
session_unset(); // Clear all session variables
session_destroy(); // Destroy the session

// Redirect to login page
header('Location: login.php');
exit;
?>
