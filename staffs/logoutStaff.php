<?php
// Start the session
session_start();

// Check if the user is logged in
if (isset($_SESSION['Sloggedin']) && $_SESSION['Sloggedin'] == true) {
    
    // Log the user out by destroying the session
   session_destroy();
    
    // Redirect the user to the login page
    header('Location: staffLogin.php');
    exit;
} else {
    // Redirect the user to the login page if they're not already logged in
    header('Location: staffLogin.php');
    exit;
}
?>
