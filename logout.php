<?php
// Start the session
session_start();

// Unset all session variables for a secure logout
session_unset();

// Destroy the session
session_destroy();

// Redirect to HomePage.html
header("Location: HomePage.html");
exit();
?>