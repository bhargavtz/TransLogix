<?php
require_once '../config.php';

header('Content-Type: application/json');

// Get tracking number from POST request
$tracking_number = isset($_POST['tracking_number']) ? trim($_POST['tracking_number']) : '';

if (empty($tracking_number)) {
    echo json_encode(['error' => 'Tracking number is required']);
    exit;
}

try {
    // Get shipment details
    $stmt = $conn->prepare("
        SELECT s.*, u.name as customer_name, u.phone_number as contact
        FROM shipments s
        LEFT JOIN users u ON s.user_id = u.id
        WHERE s.tracking_number = ?
    ");
    
    $stmt->bind_param('s', $tracking_number);
    $stmt->execute();
    $result = $stmt->get_result();
    $shipment = $result->fetch_assoc();
    
    if (!$shipment) {
        echo json_encode(['error' => 'Shipment not found']);
        exit;
    }
    
    // Get shipment updates
    $updates_stmt = $conn->prepare("
        SELECT status, location, notes, timestamp
        FROM shipment_updates
        WHERE shipment_id = ?
        ORDER BY timestamp DESC
    ");
    
    $updates_stmt->bind_param('i', $shipment['id']);
    $updates_stmt->execute();
    $updates_result = $updates_stmt->get_result();
    $updates = $updates_result->fetch_all(MYSQLI_ASSOC);
    
    // Format response
    $response = [
        'tracking_id' => $shipment['tracking_number'],
        'status' => $shipment['status'],
        'customer_name' => $shipment['customer_name'],
        'contact' => $shipment['contact'],
        'current_location' => $shipment['origin_address'],
        'destination' => $shipment['destination_address'],
        'estimated_delivery' => $shipment['created_at'], // You might want to add an estimated_delivery field to your shipments table
        'package_details' => [
            'weight' => 'N/A', // Add these fields to your shipments table if needed
            'dimensions' => 'N/A',
            'type' => 'Standard'
        ],
        'updates' => $updates
    ];
    
    echo json_encode($response);
    
} catch (Exception $e) {
    echo json_encode(['error' => 'An error occurred while fetching shipment details']);
}