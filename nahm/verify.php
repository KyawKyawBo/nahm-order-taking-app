<?php
session_start();

// Correct code
$correctCode = "0070";

// Check if the form data is submitted
if (isset($_POST['code'])) {
    $enteredCode = $_POST['code'];

    // Check if the entered code matches the correct code
    if ($enteredCode === $correctCode) {
        // Code is correct
        $_SESSION['verified'] = true;
        header("Location: dashboard.php");
    } else {
        // Code is incorrect
        header("Location: .");
    }
} else {
    // If form data is not submitted, redirect back to the login page
    header("Location: .");
    exit();
}
?>
