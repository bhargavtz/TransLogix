<?php
require_once '../config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    if (isset($input['shipment_id'], $input['status'])) {
        $shipment_id = $input['shipment_id'];
        $status = $input['status'];

        $stmt = $conn->prepare("UPDATE shipments SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $shipment_id);

        if ($stmt->execute()) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to update shipment status."]);
        }

        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "Invalid input."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}

$conn->close();
?>