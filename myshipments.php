<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('location: login.php');
    exit;
}

// Check if the user ID is set in the session
if (!isset($_SESSION['id'])) {
    die("User ID is not set in the session. Please log in again.");
}

require_once 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shipments - TransLogix</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 dark:bg-gray-900 transition-colors duration-200">
    <!-- Sidebar -->
    <aside class="fixed top-0 left-0 h-screen w-64 bg-white dark:bg-gray-800 shadow-lg z-50 transition-transform duration-300 transform" id="sidebar">
        <div class="p-6">
            <a href="/" class="text-2xl font-bold text-blue-600 dark:text-blue-400">TransLogix</a>
        </div>
        <nav class="mt-6">
            <div class="px-4 space-y-2">
                <a href="userdashboard.php" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Admin
                </a>
                <a href="myshipments.php" class="flex items-center px-4 py-3 text-gray-700 dark:text-white bg-gray-100 dark:bg-gray-700 rounded-lg">
                    <i class="fas fa-box mr-3"></i>
                    My Shipments
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                    <i class="fas fa-file-invoice mr-3"></i>
                    Invoices
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                    <i class="fas fa-map-marker-alt mr-3"></i>
                    Saved Addresses
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                    <i class="fas fa-history mr-3"></i>
                    Order History
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                    <i class="fas fa-cog mr-3"></i>
                    Settings
                </a>
            </div>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="ml-64 p-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">My Shipments</h1>
                <p class="text-gray-600 dark:text-gray-300">View and manage your shipments</p>
            </div>
        </div>

        <!-- Active Shipments -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-8 shipment-table">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Active Shipments</h2>
                <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">View all</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left border-b border-gray-200 dark:border-gray-700">
                            <th class="pb-4 text-sm font-semibold text-gray-600 dark:text-gray-300">Tracking ID</th>
                            <th class="pb-4 text-sm font-semibold text-gray-600 dark:text-gray-300">From</th>
                            <th class="pb-4 text-sm font-semibold text-gray-600 dark:text-gray-300">To</th>
                            <th class="pb-4 text-sm font-semibold text-gray-600 dark:text-gray-300">Status</th>
                            <th class="pb-4 text-sm font-semibold text-gray-600 dark:text-gray-300">Expected Delivery</th>
                            <th class="pb-4 text-sm font-semibold text-gray-600 dark:text-gray-300">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $userId = $_SESSION['id'];
                        $sql = "SELECT * FROM shipments WHERE user_id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $userId);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        while ($row = $result->fetch_assoc()) {
                            echo '<tr class="border-b border-gray-200 dark:border-gray-700">';
                            echo '<td class="py-4 text-sm text-gray-900 dark:text-white">' . htmlspecialchars($row['tracking_number']) . '</td>';
                            echo '<td class="py-4 text-sm text-gray-600 dark:text-gray-300">' . htmlspecialchars($row['origin_address']) . '</td>';
                            echo '<td class="py-4 text-sm text-gray-600 dark:text-gray-300">' . htmlspecialchars($row['destination_address']) . '</td>';
                            echo '<td class="py-4"><span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">' . htmlspecialchars($row['status']) . '</span></td>';
                            echo '<td class="py-4 text-sm text-gray-600 dark:text-gray-300">Mar 18, 2024</td>'; // Replace with actual delivery date if available
                            echo '<td class="py-4"><a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">Track</a></td>';
                            echo '</tr>';
                        }

                        $stmt->close();
                        $conn->close();
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>