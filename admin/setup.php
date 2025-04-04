<?php
require_once '../config.php';

// Create admin_users table
$sql = "CREATE TABLE IF NOT EXISTS admin_users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "એડમિન યુઝર્સ ટેબલ સફળતાપૂર્વક બનાવવામાં આવ્યું.<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Create default admin user
$admin_username = 'admin';
$admin_password = password_hash('admin123', PASSWORD_DEFAULT);

$check_sql = "SELECT id FROM admin_users WHERE username = ?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("s", $admin_username);
$check_stmt->execute();
$result = $check_stmt->get_result();

if ($result->num_rows == 0) {
    $insert_sql = "INSERT INTO admin_users (username, password) VALUES (?, ?)";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param("ss", $admin_username, $admin_password);
    
    if ($insert_stmt->execute()) {
        echo "ડિફૉલ્ટ એડમિન યુઝર સફળતાપૂર્વક બનાવવામાં આવ્યો.<br>";
        echo "યુઝરનેમ: admin<br>";
        echo "પાસવર્ડ: admin123<br>";
    } else {
        echo "Error creating admin user: " . $insert_stmt->error . "<br>";
    }
    $insert_stmt->close();
} else {
    echo "એડમિન યુઝર પહેલેથી જ અસ્તિત્વમાં છે.<br>";
}

$check_stmt->close();
$conn->close();
?>