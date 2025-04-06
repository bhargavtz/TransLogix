<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['shipment_id'])) {
    $user_id = $_SESSION['id'];
    $shipment_id = intval($_POST['shipment_id']);

    // Verify that the shipment belongs to the current user
    $verify_sql = "SELECT user_id FROM shipments WHERE id = ?";
    $stmt = $conn->prepare($verify_sql);
    $stmt->bind_param("i", $shipment_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $shipment = $result->fetch_assoc();

    if (!$shipment || $shipment['user_id'] !== $user_id) {
        header('location: myshipments.php?delete=unauthorized');
        exit;
    }

    // Delete the shipment
    $delete_sql = "DELETE FROM shipments WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("ii", $shipment_id, $user_id);

    if ($stmt->execute()) {
        header('location: myshipments.php?delete=success');
    } else {
        header('location: myshipments.php?delete=error');
    }
    exit;
}

header('location: myshipments.php');
exit;