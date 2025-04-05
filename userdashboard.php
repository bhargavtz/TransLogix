<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('location: login.php');
    exit;
}

require_once 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - TransLogix</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/TransLogix/css/user-nav.css">
</head>
<body class="bg-gray-50 dark:bg-gray-900 transition-colors duration-200">
    <!-- Sidebar -->
    <aside class="fixed top-0 left-0 h-screen w-64 bg-white dark:bg-gray-800 shadow-lg z-50 transition-transform duration-300 transform">
        <div class="p-6">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white">User Dashboard</h2>
        </div>
        <nav class="mt-6">
            <div class="px-4 space-y-2">
                <a href="/TransLogix/userdashboard.php" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                    <i class="fas fa-user-shield mr-3"></i>
                    Admin
                </a>
                <a href="/TransLogix/myshipments.php" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                    <i class="fas fa-box mr-3"></i>
                    My Shipments
                </a>
                <a href="/TransLogix/invoices.php" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                    <i class="fas fa-file-invoice mr-3"></i>
                    Invoices
                </a>
                <a href="/TransLogix/saved-addresses.php" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                    <i class="fas fa-map-marker-alt mr-3"></i>
                    Saved Addresses
                </a>
                <a href="/TransLogix/order-history.php" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                    <i class="fas fa-history mr-3"></i>
                    Order History
                </a>
                <a href="/TransLogix/settings.php" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                    <i class="fas fa-cog mr-3"></i>
                    Settings
                </a>
            </div>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="ml-64 p-8">
        <!-- Top Bar -->
        <div class="flex justify-between items-center mb-8 bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
            <div class="flex-1">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Welcome to User, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
                <p class="text-gray-600 dark:text-gray-300">Manage shipments, users and system settings</p>
            </div>
            <div class="flex items-center space-x-4">
                <button id="darkModeToggle" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700">
                    <i class="fas fa-moon dark:hidden"></i>
                    <i class="fas fa-sun hidden dark:block text-yellow-400"></i>
                </button>
                <div class="relative" x-data="{ isOpen: false }">
                    <button @click="isOpen = !isOpen" class="flex items-center space-x-2 focus:outline-none">
                        <img src="https://via.placeholder.com/40" alt="Profile" class="w-10 h-10 rounded-full">
                        <span class="text-gray-700 dark:text-white"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div x-show="isOpen" @click.away="isOpen = false" class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg py-1 z-50">
                        <a href="/TransLogix/profile.php" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <i class="fas fa-user mr-2"></i> Profile
                        </a>
                        <a href="profile.php#settings" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <i class="fas fa-cog mr-2"></i> Settings
                        </a>
                        <hr class="border-gray-200 dark:border-gray-700">
                        <a href="logout.php" class="block px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 text-center hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-300 quick-action">
                <i class="fas fa-plus-circle text-3xl text-blue-600 dark:text-blue-400 mb-4"></i>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">New Shipment</h3>
                <p class="text-gray-600 dark:text-gray-300 mt-2">Create a new shipping order</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 text-center hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-300 quick-action">
                <i class="fas fa-search text-3xl text-blue-600 dark:text-blue-400 mb-4"></i>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Track Shipment</h3>
                <p class="text-gray-600 dark:text-gray-300 mt-2">Track your existing shipments</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 text-center hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-300 quick-action">
                <i class="fas fa-download text-3xl text-blue-600 dark:text-blue-400 mb-4"></i>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Download Invoice</h3>
                <p class="text-gray-600 dark:text-gray-300 mt-2">Get your shipping invoices</p>
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
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <td class="py-4 text-sm text-gray-900 dark:text-white">#TRK001</td>
                            <td class="py-4 text-sm text-gray-600 dark:text-gray-300">Mumbai</td>
                            <td class="py-4 text-sm text-gray-600 dark:text-gray-300">Delhi</td>
                            <td class="py-4"><span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">In Transit</span></td>
                            <td class="py-4 text-sm text-gray-600 dark:text-gray-300">Mar 18, 2024</td>
                            <td class="py-4"><a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">Track</a></td>
                        </tr>
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <td class="py-4 text-sm text-gray-900 dark:text-white">#TRK002</td>
                            <td class="py-4 text-sm text-gray-600 dark:text-gray-300">Bangalore</td>
                            <td class="py-4 text-sm text-gray-600 dark:text-gray-300">Chennai</td>
                            <td class="py-4"><span class="px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded-full">Processing</span></td>
                            <td class="py-4 text-sm text-gray-600 dark:text-gray-300">Mar 20, 2024</td>
                            <td class="py-4"><a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">Track</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
                
        <!-- Quick Link to Address Management -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">Address Management</h2>
                    <p class="text-gray-600 dark:text-gray-300 mt-2">Manage your delivery addresses in our dedicated section</p>
                </div>
                <a href="saved-addresses.php" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <i class="fas fa-map-marker-alt mr-2"></i>Manage Addresses
                </a>
            </div>
        </div>

        <!-- Recent Invoices -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Recent Invoices</h2>
                <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">View all</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left border-b border-gray-200 dark:border-gray-700">
                            <th class="pb-4 text-sm font-semibold text-gray-600 dark:text-gray-300">Invoice ID</th>
                            <th class="pb-4 text-sm font-semibold text-gray-600 dark:text-gray-300">Date</th>
                            <th class="pb-4 text-sm font-semibold text-gray-600 dark:text-gray-300">Amount</th>
                            <th class="pb-4 text-sm font-semibold text-gray-600 dark:text-gray-300">Status</th>
                            <th class="pb-4 text-sm font-semibold text-gray-600 dark:text-gray-300">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <td class="py-4 text-sm text-gray-900 dark:text-white">#INV001</td>
                            <td class="py-4 text-sm text-gray-600 dark:text-gray-300">Mar 15, 2024</td>
                            <td class="py-4 text-sm text-gray-600 dark:text-gray-300">₹5,000</td>
                            <td class="py-4"><span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">Paid</span></td>
                            <td class="py-4"><a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">Download</a></td>
                        </tr>
                        <tr>
                            <td class="py-4 text-sm text-gray-900 dark:text-white">#INV002</td>
                            <td class="py-4 text-sm text-gray-600 dark:text-gray-300">Mar 10, 2024</td>
                            <td class="py-4 text-sm text-gray-600 dark:text-gray-300">₹3,500</td>
                            <td class="py-4"><span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">Paid</span></td>
                            <td class="py-4"><a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">Download</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script>
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
    
        gsap.from('.shipment-table', {
            opacity: 0,
            y: 20,
            duration: 0.6,
            delay: 0.3,
            ease: 'power2.out'
        });
    
        gsap.from('.address-card', {
            opacity: 0,
            y: 20,
            duration: 0.6,
            delay: 0.4,
            stagger: 0.1,
            ease: 'power2.out'
        });
    </script>
    </body>
    </html>