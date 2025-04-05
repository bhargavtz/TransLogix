<?php
session_start();
$pageTitle = 'Air Freight Services - TransLogix';
require_once('../includes/header.php');
require_once('../navbar.php');
?>

<main class="pt-16 bg-gray-50 dark:bg-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Air Freight Services</h1>
            <p class="text-lg text-gray-600 dark:text-gray-300">Fast and reliable air cargo solutions for time-sensitive shipments</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Service Feature 1 -->
            <div class="bg-white dark:bg-gray-900 rounded-lg shadow-md p-6 transition-transform hover:scale-105">
                <div class="text-blue-600 dark:text-blue-400 mb-4">
                    <i class="fas fa-plane text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Express Air Freight</h3>
                <p class="text-gray-600 dark:text-gray-300">Next-day and same-day delivery options for urgent shipments</p>
            </div>

            <!-- Service Feature 2 -->
            <div class="bg-white dark:bg-gray-900 rounded-lg shadow-md p-6 transition-transform hover:scale-105">
                <div class="text-blue-600 dark:text-blue-400 mb-4">
                    <i class="fas fa-box-open text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Consolidated Air Freight</h3>
                <p class="text-gray-600 dark:text-gray-300">Cost-effective solutions for combining multiple shipments</p>
            </div>

            <!-- Service Feature 3 -->
            <div class="bg-white dark:bg-gray-900 rounded-lg shadow-md p-6 transition-transform hover:scale-105">
                <div class="text-blue-600 dark:text-blue-400 mb-4">
                    <i class="fas fa-temperature-low text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Special Cargo Handling</h3>
                <p class="text-gray-600 dark:text-gray-300">Temperature-controlled and specialized handling for sensitive items</p>
            </div>
        </div>

        <!-- Benefits Section -->
        <div class="mt-16">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white text-center mb-8">Why Choose Air Freight</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white dark:bg-gray-900 rounded-lg shadow-md p-6">
                    <ul class="space-y-4">
                        <li class="flex items-center text-gray-600 dark:text-gray-300">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            Fastest shipping method available
                        </li>
                        <li class="flex items-center text-gray-600 dark:text-gray-300">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            Global reach and coverage
                        </li>
                        <li class="flex items-center text-gray-600 dark:text-gray-300">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            High security and reliability
                        </li>
                    </ul>
                </div>
                <div class="bg-white dark:bg-gray-900 rounded-lg shadow-md p-6">
                    <ul class="space-y-4">
                        <li class="flex items-center text-gray-600 dark:text-gray-300">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            Real-time tracking
                        </li>
                        <li class="flex items-center text-gray-600 dark:text-gray-300">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            Professional handling
                        </li>
                        <li class="flex items-center text-gray-600 dark:text-gray-300">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            Customs clearance assistance
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="mt-16 text-center">
            <a href="../contact.php" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition duration-300">Request a Quote</a>
        </div>
    </div>
</main>

<?php require_once('../includes/footer.php'); ?>