<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nahm";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch food items from the database
$sql = "SELECT * FROM food_item";
$result = $conn->query($sql);

$foodItems = array();

if ($result->num_rows > 0) {
    // Loop through each row and add it to the foodItems array
    while ($row = $result->fetch_assoc()) {
        $foodItems[] = $row;
    }
}

// Close the connection
$conn->close();

// Send the food items as JSON response
header('Content-Type: application/json');
echo json_encode($foodItems);
?>
