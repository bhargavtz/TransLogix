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
$sql = "SELECT s.id, s.tracking_number, s.package_type, s.weight, s.dimensions, s.shipping_method, s.shipping_cost, s.status, s.created_at, s.updated_at, 
        sa.address AS sender_address, ra.address AS receiver_address, u.username AS user_name
        FROM shipments s
        JOIN user_addresses sa ON s.sender_address_id = sa.id
        JOIN user_addresses ra ON s.receiver_address_id = ra.id
        JOIN users u ON s.user_id = u.id
        WHERE s.id = ?";

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Shipment - TransLogix</title>
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
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Shipment Details</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Tracking Number</h2>
                    <p class="text-gray-600 dark:text-gray-400"><?php echo htmlspecialchars($shipment['tracking_number']); ?></p>
                </div>
                <div>
                    <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">User</h2>
                    <p class="text-gray-600 dark:text-gray-400"><?php echo htmlspecialchars($shipment['user_name']); ?></p>
                </div>
                <div>
                    <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Sender Address</h2>
                    <p class="text-gray-600 dark:text-gray-400"><?php echo htmlspecialchars($shipment['sender_address']); ?></p>
                </div>
                <div>
                    <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Receiver Address</h2>
                    <p class="text-gray-600 dark:text-gray-400"><?php echo htmlspecialchars($shipment['receiver_address']); ?></p>
                </div>
                <div>
                    <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Package Type</h2>
                    <p class="text-gray-600 dark:text-gray-400"><?php echo htmlspecialchars($shipment['package_type']); ?></p>
                </div>
                <div>
                    <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Weight</h2>
                    <p class="text-gray-600 dark:text-gray-400"><?php echo htmlspecialchars($shipment['weight']); ?> kg</p>
                </div>
                <div>
                    <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Dimensions</h2>
                    <p class="text-gray-600 dark:text-gray-400"><?php echo htmlspecialchars($shipment['dimensions']); ?></p>
                </div>
                <div>
                    <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Shipping Method</h2>
                    <p class="text-gray-600 dark:text-gray-400"><?php echo htmlspecialchars($shipment['shipping_method']); ?></p>
                </div>
                <div>
                    <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Shipping Cost</h2>
                    <p class="text-gray-600 dark:text-gray-400">$<?php echo htmlspecialchars($shipment['shipping_cost']); ?></p>
                </div>
                <div>
                    <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Status</h2>
                    <p class="text-gray-600 dark:text-gray-400"><?php echo htmlspecialchars($shipment['status']); ?></p>
                </div>
                <div>
                    <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Created At</h2>
                    <p class="text-gray-600 dark:text-gray-400"><?php echo htmlspecialchars($shipment['created_at']); ?></p>
                </div>
                <div>
                    <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Last Updated</h2>
                    <p class="text-gray-600 dark:text-gray-400"><?php echo htmlspecialchars($shipment['updated_at']); ?></p>
                </div>
            </div>
        </div>
    </main>

    <script>
        // GSAP Animations
        gsap.from('main', {
            opacity: 0,
            y: 20,
            duration: 0.6,
            ease: 'power2.out'
        });
    </script>
</body>
</html>