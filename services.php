<?php
session_start();
$pageTitle = 'Our Services - TransLogix';
require_once('includes/header.php');
require_once('navbar.php');
?>

<main class="pt-16 bg-gray-50 dark:bg-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Our Services</h1>
            <p class="text-lg text-gray-600 dark:text-gray-300">Comprehensive logistics solutions for all your needs</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Air Freight -->
            <a href="/TransLogix/services/air-freight.php" class="block">
                <div class="bg-white dark:bg-gray-900 rounded-lg shadow-md p-6 transition-transform hover:scale-105">
                    <div class="text-blue-600 dark:text-blue-400 mb-4">
                        <i class="fas fa-plane text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Air Freight</h3>
                    <p class="text-gray-600 dark:text-gray-300">Fast and reliable air cargo services worldwide</p>
                </div>
            </a>

            <!-- Road Transport -->
            <a href="/TransLogix/services/road-transport.php" class="block">
                <div class="bg-white dark:bg-gray-900 rounded-lg shadow-md p-6 transition-transform hover:scale-105">
                    <div class="text-blue-600 dark:text-blue-400 mb-4">
                        <i class="fas fa-truck text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Road Transport</h3>
                    <p class="text-gray-600 dark:text-gray-300">Efficient ground transportation solutions</p>
                </div>
            </a>

            <!-- Rail Cargo -->
            <a href="/TransLogix/services/rail-cargo.php" class="block">
                <div class="bg-white dark:bg-gray-900 rounded-lg shadow-md p-6 transition-transform hover:scale-105">
                    <div class="text-blue-600 dark:text-blue-400 mb-4">
                        <i class="fas fa-train text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Rail Cargo</h3>
                    <p class="text-gray-600 dark:text-gray-300">Cost-effective rail freight transportation</p>
                </div>
            </a>

            <!-- Warehousing -->
            <a href="/TransLogix/services/warehousing.php" class="block">
                <div class="bg-white dark:bg-gray-900 rounded-lg shadow-md p-6 transition-transform hover:scale-105">
                    <div class="text-blue-600 dark:text-blue-400 mb-4">
                        <i class="fas fa-warehouse text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Warehousing</h3>
                    <p class="text-gray-600 dark:text-gray-300">Secure storage and inventory management</p>
                </div>
            </a>

            <!-- Last Mile Delivery -->
            <a href="/TransLogix/services/last-mile-delivery.php" class="block">
                <div class="bg-white dark:bg-gray-900 rounded-lg shadow-md p-6 transition-transform hover:scale-105">
                    <div class="text-blue-600 dark:text-blue-400 mb-4">
                        <i class="fas fa-home text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Last Mile Delivery</h3>
                    <p class="text-gray-600 dark:text-gray-300">Efficient final destination delivery services</p>
                </div>
            </a>

            <!-- Courier Services -->
            <a href="/TransLogix/services/courier-services.php" class="block">
                <div class="bg-white dark:bg-gray-900 rounded-lg shadow-md p-6 transition-transform hover:scale-105">
                    <div class="text-blue-600 dark:text-blue-400 mb-4">
                        <i class="fas fa-box text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Courier Services</h3>
                    <p class="text-gray-600 dark:text-gray-300">Express delivery for packages and documents</p>
                </div>
            </a>
        </div>

        <!-- Additional Services Info -->
        <div class="mt-16">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white text-center mb-8">Why Choose Our Services?</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white dark:bg-gray-900 rounded-lg shadow-md p-6">
                    <ul class="space-y-4">
                        <li class="flex items-center text-gray-600 dark:text-gray-300">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            Global network coverage
                        </li>
                        <li class="flex items-center text-gray-600 dark:text-gray-300">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            24/7 customer support
                        </li>
                        <li class="flex items-center text-gray-600 dark:text-gray-300">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            Real-time tracking
                        </li>
                    </ul>
                </div>
                <div class="bg-white dark:bg-gray-900 rounded-lg shadow-md p-6">
                    <ul class="space-y-4">
                        <li class="flex items-center text-gray-600 dark:text-gray-300">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            Competitive pricing
                        </li>
                        <li class="flex items-center text-gray-600 dark:text-gray-300">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            Custom solutions
                        </li>
                        <li class="flex items-center text-gray-600 dark:text-gray-300">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            Professional handling
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="mt-16 text-center">
            <a href="/TransLogix/contact.php" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition duration-300">Get a Quote</a>
        </div>
    </div>
</main>

<?php require_once('includes/footer.php'); ?>