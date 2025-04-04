<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - TransLogix</title>
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
</head>
<body>
    <?php include 'TransLogix/navbar.php'; ?>
    <main class="mt-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900">Frequently Asked Questions</h1>
        <p class="mt-4 text-gray-600">Find answers to the most common questions about our services.</p>
        <!-- FAQ content goes here -->
        <section class="py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="space-y-8">
                    <!-- FAQ Item 1 -->
                    <div class="bg-white dark:bg-gray-900 rounded-lg shadow-lg p-6">
                        <button class="faq-toggle w-full flex justify-between items-center">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">What services does TransLogix offer?</h3>
                            <i class="fas fa-chevron-down text-gray-500 dark:text-gray-400 transform transition-transform duration-200"></i>
                        </button>
                        <div class="faq-content hidden mt-4">
                            <p class="text-gray-600 dark:text-gray-300">
                                TransLogix offers a comprehensive range of logistics services including freight forwarding, warehousing, supply chain management, customs clearance, and specialized transportation solutions. We cater to both domestic and international shipping needs.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ Item 2 -->
                    <div class="bg-white dark:bg-gray-900 rounded-lg shadow-lg p-6">
                        <button class="faq-toggle w-full flex justify-between items-center">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">How can I track my shipment?</h3>
                            <i class="fas fa-chevron-down text-gray-500 dark:text-gray-400 transform transition-transform duration-200"></i>
                        </button>
                        <div class="faq-content hidden mt-4">
                            <p class="text-gray-600 dark:text-gray-300">
                                You can track your shipment easily through our online tracking system. Simply enter your tracking number on our tracking page, and you'll get real-time updates about your shipment's location and estimated delivery time.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ Item 3 -->
                    <div class="bg-white dark:bg-gray-900 rounded-lg shadow-lg p-6">
                        <button class="faq-toggle w-full flex justify-between items-center">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">What are your delivery timeframes?</h3>
                            <i class="fas fa-chevron-down text-gray-500 dark:text-gray-400 transform transition-transform duration-200"></i>
                        </button>
                        <div class="faq-content hidden mt-4">
                            <p class="text-gray-600 dark:text-gray-300">
                                Delivery timeframes vary depending on the service selected and destination. We offer express, standard, and economy options. Contact our customer service team for specific delivery estimates for your route.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ Item 4 -->
                    <div class="bg-white dark:bg-gray-900 rounded-lg shadow-lg p-6">
                        <button class="faq-toggle w-full flex justify-between items-center">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">How do I get a quote for your services?</h3>
                            <i class="fas fa-chevron-down text-gray-500 dark:text-gray-400 transform transition-transform duration-200"></i>
                        </button>
                        <div class="faq-content hidden mt-4">
                            <p class="text-gray-600 dark:text-gray-300">
                                You can request a quote through our website by filling out our quote request form, or contact our sales team directly. We'll need details about your shipment including origin, destination, dimensions, and weight to provide an accurate quote.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ Item 5 -->
                    <div class="bg-white dark:bg-gray-900 rounded-lg shadow-lg p-6">
                        <button class="faq-toggle w-full flex justify-between items-center">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">What insurance options do you offer?</h3>
                            <i class="fas fa-chevron-down text-gray-500 dark:text-gray-400 transform transition-transform duration-200"></i>
                        </button>
                        <div class="faq-content hidden mt-4">
                            <p class="text-gray-600 dark:text-gray-300">
                                We offer various insurance options to protect your shipments. Basic coverage is included in our service, and additional insurance can be purchased based on the value and nature of your goods.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Toggle Script -->
        <script>
            document.querySelectorAll('.faq-toggle').forEach(button => {
                button.addEventListener('click', () => {
                    const content = button.nextElementSibling;
                    const icon = button.querySelector('i');
                    
                    content.classList.toggle('hidden');
                    icon.classList.toggle('rotate-180');
                });
            });
        </script>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>