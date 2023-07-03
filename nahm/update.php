<?php
// Include the connection file
require_once 'connection.php';
// Check if the form data is submitted
if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['category']) && isset($_POST['price'])) {
    $itemId = $_POST['id'];
    $itemName = $_POST['name'];
    $itemCategory = $_POST['category'];
    $itemPrice = $_POST['price'];
    // Prepare and execute the SQL statement to update the item
    $stmt = $conn->prepare("UPDATE food_item SET name = ?, category = ?, price = ? WHERE id = ?");
    $stmt->bind_param("ssdi", $itemName, $itemCategory, $itemPrice, $itemId);
    $stmt->execute();
    // Close the statement
    $stmt->close();
    // Redirect back to the food items page
    header("Location: index.php");
    exit();
} else {
    // If form data is not submitted, redirect back to the food items page
    header("Location: index.php");
    exit();
}
?>