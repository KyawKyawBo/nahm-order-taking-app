<?php
session_start();

// Check if the user is verified
if (!isset($_SESSION['verified']) || $_SESSION['verified'] !== true) {
    // User is not verified, redirect back to the login page
    header("Location: .");
    exit();
}
?>