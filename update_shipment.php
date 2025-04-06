<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
        header('location: myshipments.php');
        exit;
    }

    // Get form data
    $sender_name = trim($_POST['sender_name']);
    $sender_email = trim($_POST['sender_email']);
    $sender_phone = trim($_POST['sender_phone']);
    $from_city = trim($_POST['from_city']);
    $origin_address = trim($_POST['origin_address']);
    $to_city = trim($_POST['to_city']);
    $destination_address = trim($_POST['destination_address']);
    $product_name = trim($_POST['product_name']);
    $product_type = trim($_POST['product_type']);
    $product_weight = trim($_POST['product_weight']);
    $product_width = trim($_POST['product_width']);
    $package_details = trim($_POST['package_details']);
    $service_type = trim($_POST['service_type']);

    // Calculate new price based on updated weight and service type
    function calculateShippingPrice($weight, $service_type) {
        $base_price = 0;
        
        if ($weight <= 10) {
            $base_price = 1000;
        } elseif ($weight <= 20) {
            $base_price = 900;
        } elseif ($weight <= 40) {
            $base_price = 800;
        } elseif ($weight <= 60) {
            $base_price = 700;
        } elseif ($weight <= 100) {
            $base_price = 600;
        } else {
            $base_price = 500;
        }
        
        $multiplier = 1;
        switch($service_type) {
            case 'express':
                $multiplier = 1.5;
                break;
            case 'overnight':
                $multiplier = 2;
                break;
            default: // standard
                $multiplier = 1;
        }
        
        return $base_price * $weight * $multiplier;
    }

    $price = calculateShippingPrice(floatval($product_weight), $service_type);

    // Update shipment
    $update_sql = "UPDATE shipments SET 
        sender_name = ?, 
        sender_email = ?, 
        sender_phone = ?, 
        from_city = ?, 
        origin_address = ?, 
        to_city = ?, 
        destination_address = ?, 
        product_name = ?, 
        product_type = ?, 
        product_weight = ?, 
        product_width = ?, 
        package_details = ?, 
        service_type = ?,
        price = ?
        WHERE id = ? AND user_id = ?";

    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("sssssssssssssdii", 
        $sender_name, 
        $sender_email, 
        $sender_phone, 
        $from_city, 
        $origin_address, 
        $to_city, 
        $destination_address, 
        $product_name, 
        $product_type, 
        $product_weight, 
        $product_width, 
        $package_details, 
        $service_type,
        $price,
        $shipment_id, 
        $user_id
    );

    if ($stmt->execute()) {
        header('location: myshipments.php?update=success');
    } else {
        header('location: myshipments.php?update=error');
    }
    exit;
}

header('location: myshipments.php');
exit;