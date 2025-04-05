<?php
include 'header.php';
?>

<!-- Sidebar -->
<aside class="fixed top-0 left-0 h-screen w-64 bg-white dark:bg-gray-800 shadow-lg z-50 transition-transform duration-300 transform" id="sidebar">
    <div class="p-6">
        <a href="/" class="text-2xl font-bold text-blue-600 dark:text-blue-400">TransLogix</a>
    </div>
    <nav class="mt-6">
        <div class="px-4 space-y-2">
            <a href="#" class="flex items-center px-4 py-3 text-gray-700 dark:text-white bg-gray-100 dark:bg-gray-700 rounded-lg">
.                <i class="fas fa-tachometer-alt mr-3"></i>
                Admin
            </a>
            <a href="#" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                <i class="fas fa-truck mr-3"></i>
                My Fleet
            </a>
            <a href="#" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                <i class="fas fa-calendar-alt mr-3"></i>
                Bookings
            </a>
            <a href="#" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                <i class="fas fa-file-invoice mr-3"></i>
                Invoices
            </a>
            <a href="#" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                <i class="fas fa-star mr-3"></i>
                Reviews
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
    <!-- Top Bar -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Welcome, Vendor Name</h1>
            <p class="text-gray-600 dark:text-gray-300">Here's what's happening with your business</p>
        </div>
        <div class="flex items-center space-x-4">
            <button id="darkModeToggle" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700">
                <i class="fas fa-moon dark:hidden"></i>
                <i class="fas fa-sun hidden dark:block text-yellow-400"></i>
            </button>
            <div class="relative">
                <button class="flex items-center space-x-2 focus:outline-none">
                    <img src="https://via.placeholder.com/40" alt="Profile" class="w-10 h-10 rounded-full">
                    <span class="text-gray-700 dark:text-white">John Doe</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Total Bookings</p>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">256</h3>
                </div>
                <div class="p-3 bg-blue-100 dark:bg-blue-900 rounded-full">
                    <i class="fas fa-calendar text-blue-600 dark:text-blue-400"></i>
                </div>
            </div>
            <p class="text-sm text-green-600 mt-2">+12% from last month</p>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Revenue</p>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">₹45,000</h3>
                </div>
                <div class="p-3 bg-green-100 dark:bg-green-900 rounded-full">
                    <i class="fas fa-rupee-sign text-green-600 dark:text-green-400"></i>
                </div>
            </div>
            <p class="text-sm text-green-600 mt-2">+8% from last month</p>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Active Vehicles</p>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">12</h3>
                </div>
                <div class="p-3 bg-orange-100 dark:bg-orange-900 rounded-full">
                    <i class="fas fa-truck text-orange-600 dark:text-orange-400"></i>
                </div>
            </div>
            <p class="text-sm text-green-600 mt-2">+2 this month</p>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Rating</p>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">4.8</h3>
                </div>
                <div class="p-3 bg-yellow-100 dark:bg-yellow-900 rounded-full">
                    <i class="fas fa-star text-yellow-600 dark:text-yellow-400"></i>
                </div>
            </div>
            <p class="text-sm text-green-600 mt-2">+0.2 from last month</p>
        </div>
    </div>
</main>

<?php
include 'footer.php';
?>