<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('location: login.php');
    exit;
}

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
            <div>
                <a href="addshipment.php" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg flex items-center">
                    <i class="fas fa-plus mr-2"></i>
                    Add New Shipment
                </a>
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
                            echo '<td class="py-4 text-sm text-gray-600 dark:text-gray-300">' . date('M d, Y', strtotime($row['created_at'])) . '</td>';
                            echo '<td class="py-4 flex space-x-2">
                                <a href="tracking.php?tracking_number=' . urlencode($row['tracking_number']) . '" class="text-blue-600 dark:text-blue-400 hover:underline">Track</a>
                                <button onclick="openEditModal(' . $row['id'] . ', \'' . 
                                    htmlspecialchars($row['origin_address'], ENT_QUOTES) . '\', \'' . 
                                    htmlspecialchars($row['destination_address'], ENT_QUOTES) . '\', \'' . 
                                    htmlspecialchars($row['package_details'], ENT_QUOTES) . '\')" 
                                    class="text-blue-600 dark:text-blue-400 hover:underline mx-2">Edit</button>
                                <button onclick="confirmDelete(' . $row['id'] . ')" class="text-red-600 dark:text-red-400 hover:underline">Delete</button>
                            </td>';
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
    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-3/4 shadow-lg rounded-md bg-white dark:bg-gray-800">
            <div class="mt-3">
                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white mb-4">Edit Shipment</h3>
                <form id="editForm" method="POST" action="update_shipment.php" class="space-y-4">
                    <input type="hidden" id="shipment_id" name="shipment_id">
                    
                    <!-- Address Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Origin Address</label>
                            <textarea id="origin_address" name="origin_address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Destination Address</label>
                            <textarea id="destination_address" name="destination_address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"></textarea>
                        </div>
                    </div>

                    <!-- Package Details -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Package Details</label>
                        <textarea id="package_details" name="package_details" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"></textarea>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                        <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="pending">Pending</option>
                            <option value="in_transit">In Transit</option>
                            <option value="delivered">Delivered</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>

                    <div class="flex justify-end space-x-3 mt-5">
                        <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
            <div class="mt-3 text-center">
                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Delete Shipment</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Are you sure you want to delete this shipment? This action cannot be undone.</p>
                </div>
                <div class="flex justify-center space-x-4 mt-5">
                    <button onclick="closeDeleteModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">Cancel</button>
                    <form id="deleteForm" method="POST" action="delete_shipment.php" class="inline">
                        <input type="hidden" id="delete_shipment_id" name="shipment_id">
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openEditModal(id, originAddress, destinationAddress, packageDetails) {
            document.getElementById('shipment_id').value = id;
            document.getElementById('origin_address').value = originAddress;
            document.getElementById('destination_address').value = destinationAddress;
            document.getElementById('package_details').value = packageDetails;
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        function confirmDelete(id) {
            document.getElementById('delete_shipment_id').value = id;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>
</body>
</html>