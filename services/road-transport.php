<?php
session_start();
$pageTitle = 'Road Transport Services - TransLogix';
require_once('../includes/header.php');
require_once('../navbar.php');
?>

<main class="pt-16 bg-gray-50 dark:bg-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Road Transport Services</h1>
            <p class="text-lg text-gray-600 dark:text-gray-300">Reliable and efficient road transportation solutions for your logistics needs</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Service Feature 1 -->
            <div class="bg-white dark:bg-gray-900 rounded-lg shadow-md p-6 transition-transform hover:scale-105">
                <div class="text-blue-600 dark:text-blue-400 mb-4">
                    <i class="fas fa-truck text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Full Truckload Services</h3>
                <p class="text-gray-600 dark:text-gray-300">Dedicated trucks for large shipments with point-to-point delivery</p>
            </div>

            <!-- Service Feature 2 -->
            <div class="bg-white dark:bg-gray-900 rounded-lg shadow-md p-6 transition-transform hover:scale-105">
                <div class="text-blue-600 dark:text-blue-400 mb-4">
                    <i class="fas fa-box text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Less Than Truckload</h3>
                <p class="text-gray-600 dark:text-gray-300">Cost-effective solutions for smaller shipments with consolidated delivery</p>
            </div>

            <!-- Service Feature 3 -->
            <div class="bg-white dark:bg-gray-900 rounded-lg shadow-md p-6 transition-transform hover:scale-105">
                <div class="text-blue-600 dark:text-blue-400 mb-4">
                    <i class="fas fa-clock text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Express Delivery</h3>
                <p class="text-gray-600 dark:text-gray-300">Time-critical shipments with guaranteed delivery windows</p>
            </div>
        </div>

        <!-- Benefits Section -->
        <div class="mt-16">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white text-center mb-8">Why Choose Our Road Transport</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white dark:bg-gray-900 rounded-lg shadow-md p-6">
                    <ul class="space-y-4">
                        <li class="flex items-center text-gray-600 dark:text-gray-300">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            Real-time tracking and monitoring
                        </li>
                        <li class="flex items-center text-gray-600 dark:text-gray-300">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            Professional and experienced drivers
                        </li>
                        <li class="flex items-center text-gray-600 dark:text-gray-300">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            Modern and well-maintained fleet
                        </li>
                    </ul>
                </div>
                <div class="bg-white dark:bg-gray-900 rounded-lg shadow-md p-6">
                    <ul class="space-y-4">
                        <li class="flex items-center text-gray-600 dark:text-gray-300">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            24/7 customer support
                        </li>
                        <li class="flex items-center text-gray-600 dark:text-gray-300">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            Competitive pricing
                        </li>
                        <li class="flex items-center text-gray-600 dark:text-gray-300">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            Nationwide coverage
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="mt-16 text-center">
            <a href="../contact.php" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition duration-300">Contact Us for a Quote</a>
        </div>
    </div>
</main>

<?php require_once('../includes/footer.php'); ?>