<?php
session_start();
$isLoggedIn = isset($_SESSION['user']); // Check if the user is logged in
$user = $isLoggedIn ? $_SESSION['user'] : null; // Get user data if logged in
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TransLogix Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            
        }
    
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-200">
    <?php include 'navbar.php'; // Include the common navbar ?>

    <div class="container mx-auto px-4 py-8 content-container">
        <h1 class="text-4xl font-bold text-center mb-12 text-blue-600 dark:text-blue-400">TransLogix Blog</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Sample Blog Post Card 1 -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                <img src="https://www.aeologic.com/blog/wp-content/uploads/2022/03/Top-3-Technologies-Shaping-the-Future-of-Logistics-Industry.jpg" alt="Blog Post Image" class="w-full h-48 object-cover">
                <div class="p-6">
                    <span class="text-sm text-gray-500 dark:text-gray-400">July 20, 2024</span>
                    <h2 class="text-2xl font-semibold mt-2 mb-3">The Future of Logistics Technology</h2>
                    <p class="text-gray-700 dark:text-gray-300 mb-4">Explore the upcoming trends and innovations set to revolutionize the logistics industry...</p>
                    <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">Read More &rarr;</a>
                </div>
            </div>

            <!-- Sample Blog Post Card 2 -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                <img src="https://www.vsnb.com/sites/default/files/inline-images/VSNB_Blog%20Linkedin%20%281%29%20Ensure.jpg" alt="Blog Post Image" class="w-full h-48 object-cover">
                <div class="p-6">
                    <span class="text-sm text-gray-500 dark:text-gray-400">July 15, 2024</span>
                    <h2 class="text-2xl font-semibold mt-2 mb-3">Sustainable Practices in Shipping</h2>
                    <p class="text-gray-700 dark:text-gray-300 mb-4">How TransLogix is committed to eco-friendly operations and reducing our carbon footprint...</p>
                    <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">Read More &rarr;</a>
                </div>
            </div>

            <!-- Sample Blog Post Card 3 -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                <img src="https://corporate.nvisionglobal.com/wp-content/uploads/2023/06/supply-chain-challenges-min.jpg" alt="Blog Post Image" class="w-full h-48 object-cover">
                <div class="p-6">
                    <span class="text-sm text-gray-500 dark:text-gray-400">July 10, 2024</span>
                    <h2 class="text-2xl font-semibold mt-2 mb-3">Navigating Global Supply Chains</h2>
                    <p class="text-gray-700 dark:text-gray-300 mb-4">Tips and strategies for managing complex international supply chains effectively...</p>
                    <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">Read More &rarr;</a>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; // Include the common footer ?>

    <script>
        
    </script>
</body>
</html>