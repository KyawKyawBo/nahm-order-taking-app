<?php
// Include the connection file
require_once 'connection.php';
// Check if the form data is submitted
if (isset($_POST['name']) && isset($_POST['category']) && isset($_POST['price'])) {
    $itemName = $_POST['name'];
    $itemCategory = $_POST['category'];
    $itemPrice = $_POST['price'];
    // Check if the item with the same name already exists in the database
    $checkStmt = $conn->prepare("SELECT id FROM food_item WHERE name = ?");
    $checkStmt->bind_param("s", $itemName);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    if ($checkResult->num_rows > 0) {
        // Item with the same name already exists
        echo json_encode(['success' => false, 'message' => 'Item with the same name already exists.']);
        exit();
    } else {
        // Prepare and execute the SQL statement to create the new item
        $stmt = $conn->prepare("INSERT INTO food_item (name, category, price) VALUES (?, ?, ?)");
        $stmt->bind_param("ssd", $itemName, $itemCategory, $itemPrice);
        $stmt->execute();
        // Close the statement
        $stmt->close();
        // Redirect back to the food items page
        header("Location: index.php");
        exit();
    }
} else {
    // If form data is not submitted, redirect back to the food items page
    header("Location: index.php");
    exit();
}
?>