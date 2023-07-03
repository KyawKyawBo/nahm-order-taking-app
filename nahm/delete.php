<?php
// Include the connection file
require_once 'connection.php';
// Check if the item ID is provided
if (isset($_GET['id'])) {
    $itemId = $_GET['id'];
    // Prepare and execute the SQL statement to delete the item
    $stmt = $conn->prepare("DELETE FROM food_item WHERE id = ?");
    $stmt->bind_param("i", $itemId);
    $stmt->execute();
    // Close the statement
    $stmt->close();
    // Redirect back to the food items page
    header("Location: dashboard.php");
    exit();
} else {
    // If no item ID is provided, redirect back to the food items page
    header("Location: dashboard.php");
    exit();
}
?>