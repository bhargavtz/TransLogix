<?php
session_start();
require_once 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

// Get user ID from session
$user_id = $_SESSION['id'];

try {
    // Use the existing database connection from config.php
    if (!isset($conn)) {
        die("Database connection not available");
    }

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Sanitize and validate input
        $tracking_number = trim($_POST['tracking_number']);
        $status = $_POST['status'];
        $origin_address = trim($_POST['origin_address']);
        $destination_address = trim($_POST['destination_address']);
        $package_details = trim($_POST['package_details']);
        $price = isset($_POST['price']) && is_numeric($_POST['price']) ? $_POST['price'] : null;

        // Prepare the SQL query
        $stmt = $conn->prepare("
            INSERT INTO shipments (
                user_id, tracking_number, status, origin_address, 
                destination_address, package_details, price, created_at
            ) VALUES (
                ?, ?, ?, ?, ?, ?, ?, NOW()
            )
        ");

        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        // Bind parameters
        $stmt->bind_param("issssss", $user_id, $tracking_number, $status, 
                         $origin_address, $destination_address, $package_details, $price);

        // Execute the query
        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Shipment added successfully!</div>";
            // Redirect to shipments page after 2 seconds
            header("refresh:2;url=myshipments.php");
        } else {
            echo "<div class='alert alert-danger'>Failed to add shipment. Please try again.</div>";
        }

        $stmt->close();
    }
} catch (PDOException $e) {
    // Handle database errors
    echo "<p style='color: red;'>Database error: " . $e->getMessage() . "</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Shipment</title>
    <link rel="stylesheet" href="/TransLogix/css/main.css">
    <style>
        body {
            padding: 2rem;
        }
        .container {
            max-width: 800px;
            margin: 2rem auto;
            background: var(--card-bg);
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.5s ease-in-out;
        }
        h2 {
            color: var(--primary);
            text-align: center;
            margin-bottom: 2rem;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--primary);
            font-weight: 500;
        }
        input[type="text"], input[type="number"], textarea, select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--border-color);
            border-radius: 0.375rem;
            background-color: var(--light-bg);
            color: var(--primary);
            transition: border-color 0.2s ease;
        }
        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
        }
        button {
            width: 100%;
            padding: 0.75rem;
            background-color: var(--accent);
            color: var(--text-on-dark);
            border: none;
            border-radius: 0.375rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }
        button:hover {
            background-color: var(--accent-hover);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add New Shipment</h2>
        <form method="POST" action="" class="needs-validation" novalidate>
            <div class="form-group">
                <label for="tracking_number">Tracking Number:</label>
                <input type="text" id="tracking_number" name="tracking_number" class="form-control" required>
            </div>


            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status" class="form-control" required>
                    <option value="">Select Status</option>
                    <option value="pending">Pending</option>
                    <option value="in_transit">In Transit</option>
                    <option value="delivered">Delivered</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>

            <div class="form-group">
                <label for="origin_address">Origin Address:</label>
                <textarea id="origin_address" name="origin_address" class="form-control" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label for="destination_address">Destination Address:</label>
                <textarea id="destination_address" name="destination_address" class="form-control" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label for="package_details">Package Details (Optional):</label>
                <textarea id="package_details" name="package_details" class="form-control" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label for="price">Price (Optional):</label>
                <input type="number" id="price" name="price" class="form-control" step="0.01" min="0">
            </div>

            <button type="submit" class="btn-primary">Add Shipment</button>
        </form>
    </div>
</body>
</html>