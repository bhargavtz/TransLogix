<?php
session_start();

if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    header('location: ../login.php');
    exit;
}

require_once '../config.php';

// Check if admin is logged in
$adminName = isset($_SESSION['admin_name']) ? $_SESSION['admin_name'] : null;

// Get statistics for dashboard
$totalUsers = 0;
$totalShipments = 0;
$pendingShipments = 0;
$inTransitShipments = 0;
$deliveredShipments = 0;
$totalReports = 0;

// Get total users
$userQuery = "SELECT COUNT(*) as total FROM users";
$result = $conn->query($userQuery);
if ($result) {
    $totalUsers = $result->fetch_assoc()['total'];
}

// Get shipment statistics
$shipmentQuery = "SELECT status, COUNT(*) as count FROM shipments GROUP BY status";
$result = $conn->query($shipmentQuery);
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $totalShipments++;
        switch(strtolower($row['status'])) {
            case 'pending':
                $pendingShipments = $row['count'];
                break;
            case 'in_transit':
                $inTransitShipments = $row['count'];
                break;
            case 'delivered':
                $deliveredShipments = $row['count'];
                break;
        }
    }
}

// Get total reports
$reportQuery = "SELECT COUNT(*) as total FROM reports";
$result = $conn->query($reportQuery);
if ($result) {
    $totalReports = $result->fetch_assoc()['total'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - TransLogix</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/TransLogix/css/user-nav.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
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
                <a href="contact.php" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                    <i class="fas fa-envelope mr-3"></i>
                    Contact Messages
                </a>
            </div>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="ml-64 p-8">
        <!-- Top Bar -->
        <div class="flex justify-between items-center mb-8 bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
            <div class="flex-1">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Welcome to Admin</h1>
            </div>
            <div class="flex items-center space-x-4">
                <button id="darkModeToggle" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700">
                    <i class="fas fa-moon dark:hidden"></i>
                    <i class="fas fa-sun hidden dark:block text-yellow-400"></i>
                </button>
                <div class="relative" x-data="{ isOpen: false }">
                    <button @click="isOpen = !isOpen" class="flex items-center space-x-2 focus:outline-none">
                        <img src="https://via.placeholder.com/40" alt="Profile" class="w-10 h-10 rounded-full">
                        <span class="text-gray-700 dark:text-white">Admin</span>
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div x-show="isOpen" @click.away="isOpen = false" class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg py-1 z-50">
                        <a href="profile.php" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <i class="fas fa-user mr-2"></i> Profile
                        </a>
                        <hr class="border-gray-200 dark:border-gray-700">
                        <a href="./logout.php" class="block px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Overview -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Users Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-300 quick-action">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Total Users</h3>
                        <p class="text-3xl font-bold text-blue-600 dark:text-blue-400"><?php echo $totalUsers; ?></p>
                    </div>
                    <div class="p-3 bg-blue-100 dark:bg-blue-900 rounded-full">
                        <i class="fas fa-users text-2xl text-blue-600 dark:text-blue-400"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="manage-users.php" class="text-blue-600 dark:text-blue-400 hover:underline">View Details →</a>
                </div>
            </div>

            <!-- Shipments Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-300 quick-action">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Shipments Overview</h3>
                        <p class="text-3xl font-bold text-green-600 dark:text-green-400"><?php echo $totalShipments; ?></p>
                    </div>
                    <div class="p-3 bg-green-100 dark:bg-green-900 rounded-full">
                        <i class="fas fa-box text-2xl text-green-600 dark:text-green-400"></i>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-2 mt-4">
                    <div class="text-center">
                        <p class="text-sm text-gray-600 dark:text-gray-400">Pending</p>
                        <p class="font-semibold text-yellow-600 dark:text-yellow-400"><?php echo $pendingShipments; ?></p>
                    </div>
                    <div class="text-center">
                        <p class="text-sm text-gray-600 dark:text-gray-400">In Transit</p>
                        <p class="font-semibold text-blue-600 dark:text-blue-400"><?php echo $inTransitShipments; ?></p>
                    </div>
                    <div class="text-center">
                        <p class="text-sm text-gray-600 dark:text-gray-400">Delivered</p>
                        <p class="font-semibold text-green-600 dark:text-green-400"><?php echo $deliveredShipments; ?></p>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="shipments.php" class="text-green-600 dark:text-green-400 hover:underline">View Details →</a>
                </div>
            </div>

            <!-- Reports Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-300 quick-action">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Total Reports</h3>
                        <p class="text-3xl font-bold text-purple-600 dark:text-purple-400"><?php echo $totalReports; ?></p>
                    </div>
                    <div class="p-3 bg-purple-100 dark:bg-purple-900 rounded-full">
                        <i class="fas fa-chart-line text-2xl text-purple-600 dark:text-purple-400"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="reports.php" class="text-purple-600 dark:text-purple-400 hover:underline">View Details →</a>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 text-center hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-300 quick-action">
                <i class="fas fa-user-shield text-3xl text-blue-600 dark:text-blue-400 mb-4"></i>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Manage Users</h3>
                <p class="text-gray-600 dark:text-gray-300 mt-2">Add, edit, or remove users</p>
                <a href="manage-users.php" class="mt-4 inline-block px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">Go to Users</a>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 text-center hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-300 quick-action">
                <i class="fas fa-box text-3xl text-green-600 dark:text-green-400 mb-4"></i>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Manage Shipments</h3>
                <p class="text-gray-600 dark:text-gray-300 mt-2">Track and update shipments</p>
                <a href="shipments.php" class="mt-4 inline-block px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200">Go to Shipments</a>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 text-center hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-300 quick-action">
                <i class="fas fa-chart-line text-3xl text-purple-600 dark:text-purple-400 mb-4"></i>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">View Reports</h3>
                <p class="text-gray-600 dark:text-gray-300 mt-2">Analyze system performance</p>
                <a href="reports.php" class="mt-4 inline-block px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition duration-200">Go to Reports</a>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Dark mode toggle
            const darkModeToggle = document.getElementById('darkModeToggle');
            const html = document.documentElement;

            darkModeToggle.addEventListener('click', () => {
                html.classList.toggle('dark');
                localStorage.setItem('darkMode', html.classList.contains('dark'));
            });

            // Check for saved dark mode preference
            if (localStorage.getItem('darkMode') === 'true') {
                html.classList.add('dark');
            }

            // GSAP Animations
            gsap.from('.quick-action', {
                opacity: 0,
                y: 20,
                duration: 0.6,
                stagger: 0.1,
                ease: 'power2.out'
            });
        });
    </script>
</body>
</html>