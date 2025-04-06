<?php
require_once '../config.php';

header('Content-Type: application/json');

$tracking_number = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tracking_number = $_POST['tracking_number'] ?? '';
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $tracking_number = $_GET['tracking_number'] ?? '';
}

if (empty($tracking_number)) {
    echo json_encode(["error" => "Tracking number is required."]);
    exit;
}

$sql = "SELECT s.*, u.username AS customer_name, u.contact 
        FROM shipments s 
        LEFT JOIN users u ON s.user_id = u.id 
        WHERE s.tracking_number = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $tracking_number);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $shipment = $result->fetch_assoc();
    $shipment['current_coordinates'] = ['lat' => 23.0225, 'lng' => 72.5714]; // Example coordinates for Ahmedabad
    $shipment['destination_coordinates'] = ['lat' => 19.0760, 'lng' => 72.8777]; // Example coordinates for Mumbai
    $shipment['updates'] = [
        [
            'status' => $shipment['status'],
            'timestamp' => $shipment['created_at'],
            'location' => $shipment['origin_address'],
            'notes' => 'Shipment registered'
        ],
        [
            'status' => $shipment['status'],
            'timestamp' => $shipment['updated_at'],
            'location' => $shipment['destination_address'],
            'notes' => 'Current status'
        ]
    ];
    echo json_encode($shipment);
} else {
    echo json_encode(["error" => "Tracking number not found."]);
}

$stmt->close();
$conn->close();
?>