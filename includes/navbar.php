<?php
// Only start the session if one hasn't been started already
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isLoggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
$username = $isLoggedIn ? $_SESSION['username'] : null;
?>
<nav class="bg-white dark:bg-gray-900 fixed w-full z-50 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="/" class="text-2xl font-bold text-blue-600 dark:text-blue-400">TransLogix</a>
            </div>
            <div class="hidden md:flex items-center space-x-8">
                <a href="../index.php" class="nav-link text-gray-700 dark:text-white hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200 relative group">
                    <span class="relative z-10">Home</span>
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-600 dark:bg-blue-400 group-hover:w-full transition-all duration-200"></span>
                </a>
                <a href="../about.php" class="nav-link text-gray-700 dark:text-white hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200 relative group">
                    <span class="relative z-10">About</span>
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-600 dark:bg-blue-400 group-hover:w-full transition-all duration-200"></span>
                </a>
                <div class="relative group">
                    <a href="../services.php" class="nav-link text-gray-700 dark:text-white hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200 relative group flex items-center">
                        <span class="relative z-10">Services</span>
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-600 dark:bg-blue-400 group-hover:w-full transition-all duration-200"></span>
                    </a>
                    <div class="absolute left-0 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-800 hidden group-hover:block">
                        <div class="py-1">
                            <a href="../services/road-transport.php" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Road Transport</a>
                            <a href="../services/rail-cargo.php" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Rail Cargo</a>
                            <a href="../services/air-freight.php" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Air Freight</a>
                            <a href="../services/warehousing.php" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Warehousing</a>
                            <a href="../services/courier-services.php" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Courier Services</a>
                            <a href="../services/last-mile-delivery.php" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Last Mile Delivery</a>
                        </div>
                    </div>
                </div>
                <a href="../tracking.php" class="nav-link text-gray-700 dark:text-white hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200 relative group">
                    <span class="relative z-10">Tracking</span>
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-600 dark:bg-blue-400 group-hover:w-full transition-all duration-200"></span>
                </a>
                <a href="../contact.php" class="nav-link text-gray-700 dark:text-white hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200 relative group">
                    <span class="relative z-10">Contact</span>
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-600 dark:bg-blue-400 group-hover:w-full transition-all duration-200"></span>
                </a>
                <?php if ($isLoggedIn): ?>
                    <div class="relative group">
                        <button class="flex items-center space-x-2 text-gray-700 dark:text-white hover:text-blue-600 dark:hover:text-blue-400">
                            <span><?php echo htmlspecialchars($username); ?></span>
                            <i class="fas fa-user"></i>
                        </button>
                        <div class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-800 hidden group-hover:block">
                            <div class="py-1">
                                <a href="../profile.php" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Profile</a>
                                <a href="../myshipments.php" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">My Shipments</a>
                                <a href="../logout.php" class="block px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700">Logout</a>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="../login.php" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-500">Login</a>
                <?php endif; ?>
                <button id="darkModeToggle" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800">
                    <i class="fas fa-moon dark:hidden"></i>
                    <i class="fas fa-sun hidden dark:block text-yellow-400"></i>
                </button>
            </div>
            <div class="md:hidden flex items-center">
                <button id="mobileMenuBtn" class="text-gray-700 dark:text-white hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden md:hidden bg-white dark:bg-gray-900 w-full border-t dark:border-gray-800">
            <div class="px-4 py-2 space-y-2">
                <a href="../index.php" class="block py-2 text-gray-700 dark:text-white hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200">Home</a>
                <a href="../about.php" class="block py-2 text-gray-700 dark:text-white hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200">About</a>
                <div class="space-y-1">
                    <a href="../services.php" class="block py-2 text-gray-700 dark:text-white hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200">Services</a>
                    <a href="../services/road-transport.php" class="block py-2 pl-4 text-sm text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200">Road Transport</a>
                    <a href="../services/rail-cargo.php" class="block py-2 pl-4 text-sm text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200">Rail Cargo</a>
                    <a href="../services/air-freight.php" class="block py-2 pl-4 text-sm text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200">Air Freight</a>
                    <a href="../services/warehousing.php" class="block py-2 pl-4 text-sm text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200">Warehousing</a>
                    <a href="../services/courier-services.php" class="block py-2 pl-4 text-sm text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200">Courier Services</a>
                    <a href="../services/last-mile-delivery.php" class="block py-2 pl-4 text-sm text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200">Last Mile Delivery</a>
                </div>
                <a href="../tracking.php" class="block py-2 text-gray-700 dark:text-white hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200">Tracking</a>
                <a href="../contact.php" class="block py-2 text-gray-700 dark:text-white hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200">Contact</a>
                <?php if ($isLoggedIn): ?>
                    <a href="../profile.php" class="block py-2 text-gray-700 dark:text-white hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200">Profile</a>
                    <a href="../myshipments.php" class="block py-2 text-gray-700 dark:text-white hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200">My Shipments</a>
                    <a href="../logout.php" class="block py-2 text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-500 transition-colors duration-200">Logout</a>
                <?php else: ?>
                    <a href="../login.php" class="block py-2 text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-500 transition-colors duration-200">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<script>
    // Mobile menu toggle
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');

    mobileMenuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });

    // Dark mode toggle
    const darkModeToggle = document.getElementById('darkModeToggle');
    
    // Check for saved dark mode preference
    if (localStorage.getItem('darkMode') === 'true' || 
        (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    }

    darkModeToggle.addEventListener('click', () => {
        document.documentElement.classList.toggle('dark');
        localStorage.setItem('darkMode', document.documentElement.classList.contains('dark'));
    });
</script>