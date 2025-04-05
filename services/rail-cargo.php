<?php
session_start();
$pageTitle = 'Rail Cargo Services - TransLogix';
require_once('../includes/header.php');
require_once('../navbar.php');
?>

<main class="pt-16 bg-gray-50 dark:bg-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Rail Cargo Services</h1>
            <p class="text-lg text-gray-600 dark:text-gray-300">Efficient and sustainable rail transportation solutions</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Service Feature 1 -->
            <div class="bg-white dark:bg-gray-900 rounded-lg shadow-md p-6 transition-transform hover:scale-105">
                <div class="text-blue-600 dark:text-blue-400 mb-4">
                    <i class="fas fa-train text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Container Transport</h3>
                <p class="text-gray-600 dark:text-gray-300">Secure and efficient container transportation across major routes</p>
            </div>

            <!-- Service Feature 2 -->
            <div class="bg-white dark:bg-gray-900 rounded-lg shadow-md p-6 transition-transform hover:scale-105">
                <div class="text-blue-600 dark:text-blue-400 mb-4">
                    <i class="fas fa-warehouse text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Bulk Cargo</h3>
                <p class="text-gray-600 dark:text-gray-300">Specialized solutions for bulk materials and commodities</p>
            </div>

            <!-- Service Feature 3 -->
            <div class="bg-white dark:bg-gray-900 rounded-lg shadow-md p-6 transition-transform hover:scale-105">
                <div class="text-blue-600 dark:text-blue-400 mb-4">
                    <i class="fas fa-route text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Intermodal Services</h3>
                <p class="text-gray-600 dark:text-gray-300">Seamless integration with other transport modes for complete logistics solutions</p>
            </div>
        </div>

        <!-- Benefits Section -->
        <div class="mt-16">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white text-center mb-8">Advantages of Rail Transport</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white dark:bg-gray-900 rounded-lg shadow-md p-6">
                    <ul class="space-y-4">
                        <li class="flex items-center text-gray-600 dark:text-gray-300">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            Environmentally friendly transportation
                        </li>
                        <li class="flex items-center text-gray-600 dark:text-gray-300">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            Cost-effective for long distances
                        </li>
                        <li class="flex items-center text-gray-600 dark:text-gray-300">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            High capacity for bulk shipments
                        </li>
                    </ul>
                </div>
                <div class="bg-white dark:bg-gray-900 rounded-lg shadow-md p-6">
                    <ul class="space-y-4">
                        <li class="flex items-center text-gray-600 dark:text-gray-300">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            Reliable schedules
                        </li>
                        <li class="flex items-center text-gray-600 dark:text-gray-300">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            Advanced tracking systems
                        </li>
                        <li class="flex items-center text-gray-600 dark:text-gray-300">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            Extensive network coverage
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="mt-16 text-center">
            <a href="../contact.php" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition duration-300">Get a Custom Quote</a>
        </div>
    </div>
</main>

<?php require_once('../includes/footer.php'); ?>