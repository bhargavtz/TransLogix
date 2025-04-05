<?php
session_start();
$pageTitle = 'Warehousing Services - TransLogix';
require_once('../includes/header.php');
require_once('../navbar.php');
?>

<main class="pt-16 bg-gray-50 dark:bg-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Warehousing Services</h1>
            <p class="text-lg text-gray-600 dark:text-gray-300">Secure and efficient storage solutions for your business needs</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Service Feature 1 -->
            <div class="bg-white dark:bg-gray-900 rounded-lg shadow-md p-6 transition-transform hover:scale-105">
                <div class="text-blue-600 dark:text-blue-400 mb-4">
                    <i class="fas fa-warehouse text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Storage Solutions</h3>
                <p class="text-gray-600 dark:text-gray-300">Short-term and long-term storage options with flexible space allocation</p>
            </div>

            <!-- Service Feature 2 -->
            <div class="bg-white dark:bg-gray-900 rounded-lg shadow-md p-6 transition-transform hover:scale-105">
                <div class="text-blue-600 dark:text-blue-400 mb-4">
                    <i class="fas fa-box-open text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Inventory Management</h3>
                <p class="text-gray-600 dark:text-gray-300">Advanced tracking and management systems for optimal stock control</p>
            </div>

            <!-- Service Feature 3 -->
            <div class="bg-white dark:bg-gray-900 rounded-lg shadow-md p-6 transition-transform hover:scale-105">
                <div class="text-blue-600 dark:text-blue-400 mb-4">
                    <i class="fas fa-dolly text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Order Fulfillment</h3>
                <p class="text-gray-600 dark:text-gray-300">Efficient pick, pack, and ship services for e-commerce businesses</p>
            </div>
        </div>

        <!-- Benefits Section -->
        <div class="mt-16">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white text-center mb-8">Our Warehousing Advantages</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white dark:bg-gray-900 rounded-lg shadow-md p-6">
                    <ul class="space-y-4">
                        <li class="flex items-center text-gray-600 dark:text-gray-300">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            State-of-the-art facilities
                        </li>
                        <li class="flex items-center text-gray-600 dark:text-gray-300">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            24/7 security monitoring
                        </li>
                        <li class="flex items-center text-gray-600 dark:text-gray-300">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            Climate-controlled storage
                        </li>
                    </ul>
                </div>
                <div class="bg-white dark:bg-gray-900 rounded-lg shadow-md p-6">
                    <ul class="space-y-4">
                        <li class="flex items-center text-gray-600 dark:text-gray-300">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            Real-time inventory tracking
                        </li>
                        <li class="flex items-center text-gray-600 dark:text-gray-300">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            Flexible storage options
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
            <a href="../contact.php" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition duration-300">Discuss Your Storage Needs</a>
        </div>
    </div>
</main>

<?php require_once('../includes/footer.php'); ?>