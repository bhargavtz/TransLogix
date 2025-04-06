<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    header('location: ../login.php');
    exit;
}

if (!isset($_GET['id'])) {
    header('location: shipments.php');
    exit;
}

$shipment_id = intval($_GET['id']);
$success_message = '';
$error_message = '';

// Fetch shipment details
$sql = "SELECT tracking_number, package_type, weight, dimensions, shipping_method, shipping_cost, status FROM shipments WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $shipment_id);
$stmt->execute();
$result = $stmt->get_result();
$shipment = $result->fetch_assoc();
$stmt->close();

if (!$shipment) {
    header('location: shipments.php');
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tracking_number = trim($_POST['tracking_number']);
    $package_type = trim($_POST['package_type']);
    $weight = floatval($_POST['weight']);
    $dimensions = trim($_POST['dimensions']);
    $shipping_method = trim($_POST['shipping_method']);
    $shipping_cost = floatval($_POST['shipping_cost']);
    $status = trim($_POST['status']);

    $update_sql = "UPDATE shipments SET tracking_number = ?, package_type = ?, weight = ?, dimensions = ?, shipping_method = ?, shipping_cost = ?, status = ? WHERE id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("ssdsdsii", $tracking_number, $package_type, $weight, $dimensions, $shipping_method, $shipping_cost, $status, $shipment_id);

    if ($stmt->execute()) {
        $success_message = "Shipment updated successfully!";
    } else {
        $error_message = "Failed to update shipment.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Shipment - TransLogix</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/TransLogix/css/user-nav.css">
</head>
<body class="bg-gray-50 dark:bg-gray-900 transition-colors duration-200">
    <!-- Sidebar -->
    <aside class="fixed top-0 left-0 h-screen w-64 bg-white dark:bg-gray-800 shadow-lg z-50 transition-transform duration-300 transform">
        <div class="p-6">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white">Admin Dashboard</h2>
        </div>
        <nav class="mt-6">
            <div class="px-4 space-y-2">
                <a href="dashboard.php" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>
                <a href="manage-users.php" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                    <i class="fas fa-users mr-3"></i>
                    User Management
                </a>
                <a href="shipments.php" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                    <i class="fas fa-box mr-3"></i>
                    Shipments
                </a>
                <a href="reports.php" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                    <i class="fas fa-chart-line mr-3"></i>
                    Reports
                </a>
                <a href="settings.php" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                    <i class="fas fa-cog mr-3"></i>
                    Settings
                </a>
            </div>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="ml-64 p-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Edit Shipment</h1>

            <?php if ($success_message): ?>
                <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                    <?php echo $success_message; ?>
                </div>
            <?php endif; ?>

            <?php if ($error_message): ?>
                <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-6">
                <div>
                    <label class="block text-gray-700 dark:text-gray-300">Tracking Number</label>
                    <input type="text" name="tracking_number" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white" value="<?php echo htmlspecialchars($shipment['tracking_number']); ?>" required>
                </div>
                <div>
                    <label class="block text-gray-700 dark:text-gray-300">Package Type</label>
                    <input type="text" name="package_type" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white" value="<?php echo htmlspecialchars($shipment['package_type']); ?>" required>
                </div>
                <div>
                    <label class="block text-gray-700 dark:text-gray-300">Weight (kg)</label>
                    <input type="number" step="0.01" name="weight" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white" value="<?php echo htmlspecialchars($shipment['weight']); ?>" required>
                </div>
                <div>
                    <label class="block text-gray-700 dark:text-gray-300">Dimensions</label>
                    <input type="text" name="dimensions" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white" value="<?php echo htmlspecialchars($shipment['dimensions']); ?>">
                </div>
                <div>
                    <label class="block text-gray-700 dark:text-gray-300">Shipping Method</label>
                    <input type="text" name="shipping_method" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white" value="<?php echo htmlspecialchars($shipment['shipping_method']); ?>" required>
                </div>
                <div>
                    <label class="block text-gray-700 dark:text-gray-300">Shipping Cost ($)</label>
                    <input type="number" step="0.01" name="shipping_cost" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white" value="<?php echo htmlspecialchars($shipment['shipping_cost']); ?>" required>
                </div>
                <div>
                    <label class="block text-gray-700 dark:text-gray-300">Status</label>
                    <select name="status" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white">
                        <option value="pending" <?php echo $shipment['status'] === 'pending' ? 'selected' : ''; ?>>Pending</option>
                        <option value="in_transit" <?php echo $shipment['status'] === 'in_transit' ? 'selected' : ''; ?>>In Transit</option>
                        <option value="delivered" <?php echo $shipment['status'] === 'delivered' ? 'selected' : ''; ?>>Delivered</option>
                        <option value="cancelled" <?php echo $shipment['status'] === 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                    </select>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Save Changes</button>
                </div>
            </form>
        </div>
    </main>

    <script>
        // GSAP Animations
        gsap.from('form', {
            opacity: 0,
            y: 20,
            duration: 0.6,
            ease: 'power2.out'
        });
    </script>
</body>
</html>