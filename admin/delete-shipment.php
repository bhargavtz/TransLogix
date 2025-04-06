<?php
session_start();

if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit;
}

require_once '../config.php';

// Check if the request is POST and contains JSON data
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty(file_get_contents('php://input'))) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Invalid request method or data']);
    exit;
}

// Get and validate the shipment ID
$data = json_decode(file_get_contents('php://input'), true);
$shipmentId = isset($data['shipment_id']) ? intval($data['shipment_id']) : 0;

if ($shipmentId <= 0) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Invalid shipment ID']);
    exit;
}

// Delete the shipment from database
$stmt = $conn->prepare("DELETE FROM shipments WHERE id = ?");
$stmt->bind_param("i", $shipmentId);

if ($stmt->execute()) {
    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'message' => 'Shipment deleted successfully']);
} else {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Failed to delete shipment']);
}

$stmt->close();
$conn->close();