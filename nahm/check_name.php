<?php
// Connect to the database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'nahm';
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
// Get the name from the AJAX request
$name = $_POST['name'];
// Perform a database query to check if the name exists
$sql = "SELECT * FROM food_item WHERE name = '$name'";
$result = $conn->query($sql);
// Check if any rows are returned
if ($result->num_rows > 0) {
    echo 'exists'; // Name already exists
} else {
    echo 'available'; // Name is available
}
$conn->close();
?>