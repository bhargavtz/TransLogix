<?php
// Database configuration
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'translogix');

// Create a connection to the database
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define username and password
$username = "admin";
$password = password_hash("admin123", PASSWORD_DEFAULT);

// Prepare the SQL statement
$sql = "INSERT INTO admin_users (username, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);

// Check if the statement was prepared successfully
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

// Bind parameters and execute the query
$stmt->bind_param("ss", $username, $password);

if ($stmt->execute()) {
    echo "User created successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>