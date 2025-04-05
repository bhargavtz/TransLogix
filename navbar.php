<?php
$isLoggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
$username = $isLoggedIn ? $_SESSION['username'] : null;
?>
<link rel="stylesheet" href="/TransLogix/css/user-nav.css">
<nav class="bg-white dark:bg-gray-900 fixed w-full z-50 shadow-md transition-all duration-300" id="navbar">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center space-x-4">
                <a href="/TransLogix/index.php" class="text-gray-700 dark:text-white hover:text-blue-600 dark:hover:text-blue-400 transition duration-300">Home</a>
                <div class="relative group">
                    <a href="/TransLogix/services.php" class="text-gray-700 dark:text-white hover:text-blue-600 dark:hover:text-blue-400 transition duration-300 flex items-center">
                        Services
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </a>
                    <div class="absolute left-0 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-800 hidden group-hover:block">
                        <div class="py-1">
                            <a href="/TransLogix/services/road-transport.php" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Road Transport</a>
                            <a href="/TransLogix/services/rail-cargo.php" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Rail Cargo</a>
                            <a href="/TransLogix/services/air-freight.php" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Air Freight</a>
                            <a href="/TransLogix/services/warehousing.php" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Warehousing</a>
                            <a href="/TransLogix/services/courier-services.php" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Courier Services</a>
                            <a href="/TransLogix/services/last-mile-delivery.php" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Last Mile Delivery</a>
                        </div>
                    </div>
                </div>
                <a href="/TransLogix/about.php" class="text-gray-700 dark:text-white hover:text-blue-600 dark:hover:text-blue-400 transition duration-300">About</a>
                <a href="/TransLogix/blog.php" class="text-gray-700 dark:text-white hover:text-blue-600 dark:hover:text-blue-400 transition duration-300">Blog</a>
                <a href="/TransLogix/contact.php" class="text-gray-700 dark:text-white hover:text-blue-600 dark:hover:text-blue-400 transition duration-300">Contact</a>
                <a href="/TransLogix/tracking.php" class="text-gray-700 dark:text-white hover:text-blue-600 dark:hover:text-blue-400 transition duration-300">Track</a>
            </div>
            <div class="flex items-center space-x-4">
            <?php if ($isLoggedIn): ?>
                <div class="user-nav">
                    <button class="user-profile-button">
                        <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white text-lg font-semibold">
                            <?= strtoupper(substr($username, 0, 1)) ?>
                        </div>
                        <div class="user-info">
                            <div class="user-name text-gray-700 dark:text-white"><?= htmlspecialchars($username) ?></div>
                            <div class="user-role text-gray-500 dark:text-gray-400">User</div>
                        </div>
                        <i class="fas fa-chevron-down ml-2 text-gray-700 dark:text-white"></i>
                    </button>
                    <div class="user-dropdown">
                        <div class="user-dropdown-header">
                            <div class="font-semibold text-gray-900 dark:text-white"><?= htmlspecialchars($username) ?></div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">User Account</div>
                        </div>
                        <div class="user-dropdown-content">
                            <a href="/TransLogix/profile.php" class="user-dropdown-item">
                                <i class="fas fa-user"></i>
                                <span>Profile</span>
                            </a>
                            <a href="/TransLogix/myshipments.php" class="user-dropdown-item">
                                <i class="fas fa-box"></i>
                                <span>My Shipments</span>
                            </a>
                            <a href="/TransLogix/tracking.php" class="user-dropdown-item">
                                <i class="fas fa-truck"></i>
                                <span>Track Shipment</span>
                            </a>
                            <a href="/TransLogix/logout.php" class="user-dropdown-item text-red-600 dark:text-red-400">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <a href="/TransLogix/login.php" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">Login</a>
            <?php endif; ?>
            <!-- Dark Mode Toggle -->
            <button id="themeToggle" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800">
                <i class="fas fa-moon dark:hidden"></i>
                <i class="fas fa-sun hidden dark:block text-yellow-400"></i>
            </button>
        </div>
    </div>
</nav>

<script>
    const themeToggle = document.getElementById('themeToggle');
    const html = document.documentElement;

    function toggleTheme() {
        const isDark = html.classList.contains('dark');
        html.classList.toggle('dark', !isDark);
        localStorage.setItem('theme', !isDark ? 'dark' : 'light');
    }

    // Initialize theme based on saved preference or system preference
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        html.classList.toggle('dark', savedTheme === 'dark');
    } else {
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        html.classList.toggle('dark', prefersDark);
    }

    // Attach event listener to the toggle button
    themeToggle.addEventListener('click', toggleTheme);
</script>
