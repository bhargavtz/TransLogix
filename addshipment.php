<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

// Add missing columns if they don't exist
$alterTableSQL = "ALTER TABLE shipments 
    ADD COLUMN IF NOT EXISTS sender_name VARCHAR(100) NOT NULL,
    ADD COLUMN IF NOT EXISTS sender_email VARCHAR(100) NOT NULL,
    ADD COLUMN IF NOT EXISTS sender_phone VARCHAR(20) NOT NULL,
    ADD COLUMN IF NOT EXISTS from_city VARCHAR(100) NOT NULL,
    ADD COLUMN IF NOT EXISTS to_city VARCHAR(100) NOT NULL,
    ADD COLUMN IF NOT EXISTS product_name VARCHAR(255) NOT NULL,
    ADD COLUMN IF NOT EXISTS product_type VARCHAR(100) NOT NULL,
    ADD COLUMN IF NOT EXISTS product_weight DECIMAL(10,2) NOT NULL,
    ADD COLUMN IF NOT EXISTS product_width VARCHAR(50),
    ADD COLUMN IF NOT EXISTS service_type VARCHAR(50) NOT NULL";

try {
    $conn->multi_query($alterTableSQL);
    while ($conn->next_result()) {;} // clear multi_query results
} catch (Exception $e) {
    // Log error but continue
    error_log("Error altering table: " . $e->getMessage());
}

$user_id = $_SESSION['id'];

// Fetch user's saved addresses
$saved_addresses_query = "SELECT * FROM user_addresses WHERE user_id = ?";
$stmt = $conn->prepare($saved_addresses_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$saved_addresses = $stmt->get_result();

function calculateShippingPrice($weight, $service_type) {
    $base_price = 0;
    
    // Calculate base price based on weight range
    if ($weight <= 10) {
        $base_price = 1000;
    } elseif ($weight <= 20) {
        $base_price = 900;
    } elseif ($weight <= 40) {
        $base_price = 800;
    } elseif ($weight <= 60) {
        $base_price = 700;
    } elseif ($weight <= 100) {
        $base_price = 600;
    } else {
        $base_price = 500;
    }
    
    $multiplier = 1;
    switch($service_type) {
        case 'express':
            $multiplier = 1.5;
            break;
        case 'overnight':
            $multiplier = 2;
            break;
        default: // standard
            $multiplier = 1;
    }
    
    // Calculate final price
    return $base_price * $weight * $multiplier;
}

try {
    if (!isset($conn)) {
        die("Database connection not available");
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Generate tracking number
        $tracking_number = 'TL' . time() . rand(1000, 9999);
        $status = 'pending';
        
        // Get form data
        $sender_name = trim($_POST['sender_name']);
        $sender_email = trim($_POST['sender_email']);
        $sender_phone = trim($_POST['sender_phone']);
        $from_city = trim($_POST['from_city']);
        $origin_address = trim($_POST['origin_address']);
        $to_city = trim($_POST['to_city']);
        $destination_address = trim($_POST['destination_address']);
        $product_name = trim($_POST['product_name']);
        $product_type = trim($_POST['product_type']);
        $product_weight = trim($_POST['product_weight']);
        $product_width = trim($_POST['product_width']);
        $package_details = trim($_POST['package_details']);
        $service_type = trim($_POST['service_type']);
        $price = calculateShippingPrice(floatval($product_weight), $service_type);

        $stmt = $conn->prepare("
            INSERT INTO shipments (
                user_id, sender_name, sender_email, sender_phone, from_city,
                origin_address, to_city, destination_address, product_name,
                product_type, product_weight, product_width, package_details, service_type,
                tracking_number, status, price
            ) VALUES (
                ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
            )
        ");

        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("isssssssssssssssd", 
            $user_id, $sender_name, $sender_email, $sender_phone, $from_city,
            $origin_address, $to_city, $destination_address, $product_name,
            $product_type, $product_weight, $product_width, $package_details, $service_type,
            $tracking_number, $status, $price);

        if ($stmt->execute()) {
            $shipment_id = $conn->insert_id;
            header("Location: payment.php?shipment_id=" . $shipment_id);
            exit;
        } else {
            $error = "Failed to add shipment. Please try again.";
        }

        $stmt->close();
    }
} catch (PDOException $e) {
    // Handle database errors
    echo "<p style='color: red;'>Database error: " . $e->getMessage() . "</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Shipment - TransLogix</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/TransLogix/css/user-nav.css">
</head>
<body class="bg-gray-50 dark:bg-gray-900 transition-colors duration-200">
    <!-- Sidebar -->
    <aside class="fixed top-0 left-0 h-screen w-64 bg-white dark:bg-gray-800 shadow-lg z-50 transition-transform duration-300 transform">
        <div class="p-6">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white">User Dashboard</h2>
        </div>
        <nav class="mt-6">
            <div class="px-4 space-y-2">
                <a href="/TransLogix/userdashboard.php" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>
                <a href="/TransLogix/myshipments.php" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                    <i class="fas fa-box mr-3"></i>
                    My Shipments
                </a>
                <a href="/TransLogix/saved-addresses.php" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                    <i class="fas fa-map-marker-alt mr-3"></i>
                    Saved Addresses
                </a>
                <a href="/TransLogix/settings.php" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                    <i class="fas fa-cog mr-3"></i>
                    Settings
                </a>
            </div>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="ml-64 p-8">
        <!-- Top Bar -->
        <div class="flex justify-between items-center mb-8 bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
            <div class="flex-1">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Add New Shipment</h1>
                <p class="text-gray-600 dark:text-gray-300">Fill in the shipment details below</p>
            </div>
            <div class="flex items-center space-x-4">
                <button id="darkModeToggle" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700">
                    <i class="fas fa-moon dark:hidden"></i>
                    <i class="fas fa-sun hidden dark:block text-yellow-400"></i>
                </button>
            </div>
        </div>

        <!-- Shipment Form -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
            <form method="POST" action="" class="space-y-6">

                <!-- Sender Details -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Sender Name</label>
                        <input type="text" name="sender_name" class="w-full px-4 py-2 rounded-lg border dark:border-gray-600 focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Sender Email</label>
                        <input type="email" name="sender_email" class="w-full px-4 py-2 rounded-lg border dark:border-gray-600 focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Sender Phone</label>
                        <input type="tel" name="sender_phone" class="w-full px-4 py-2 rounded-lg border dark:border-gray-600 focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white" required>
                    </div>
                </div>

                <!-- Origin & Destination -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">From City</label>
                        <input type="text" name="from_city" class="w-full px-4 py-2 rounded-lg border dark:border-gray-600 focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white" required>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mt-4 mb-2">Origin Address</label>
                        <textarea name="origin_address" rows="3" class="w-full px-4 py-2 rounded-lg border dark:border-gray-600 focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white" required></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">To City</label>
                        <input type="text" name="to_city" class="w-full px-4 py-2 rounded-lg border dark:border-gray-600 focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white" required>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mt-4 mb-2">Destination Address</label>
                        <div class="flex space-x-4">
                            <textarea name="destination_address" id="destination_address" rows="3" class="w-3/4 px-4 py-2 rounded-lg border dark:border-gray-600 focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white" required></textarea>
                            <div class="w-1/4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Saved Addresses</label>
                                <select id="saved_addresses" class="w-full px-4 py-2 rounded-lg border dark:border-gray-600 focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white" onchange="fillAddress()">
                                    <option value="">Select Address</option>
                                    <?php while($address = $saved_addresses->fetch_assoc()): ?>
                                        <option value="<?php echo htmlspecialchars($address['street'] . ', ' . $address['apartment'] . ', ' . $address['city'] . ', ' . $address['state'] . ' - ' . $address['pincode']); ?>">
                                            <?php echo htmlspecialchars($address['address_type']); ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Package Details -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Product Name</label>
                        <input type="text" name="product_name" class="w-full px-4 py-2 rounded-lg border dark:border-gray-600 focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Product Type</label>
                        <input type="text" name="product_type" class="w-full px-4 py-2 rounded-lg border dark:border-gray-600 focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Product Weight (KG)</label>
                        <input type="number" name="product_weight" step="0.01" min="0" class="w-full px-4 py-2 rounded-lg border dark:border-gray-600 focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white" required>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mt-4 mb-2">Product Width</label>
                        <input type="text" name="product_width" class="w-full px-4 py-2 rounded-lg border dark:border-gray-600 focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Package Details</label>
                        <textarea name="package_details" rows="3" class="w-full px-4 py-2 rounded-lg border dark:border-gray-600 focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white" placeholder="Enter package description, dimensions, or special handling instructions"></textarea>
                    </div>
                </div>

                <!-- Service Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Service Type</label>
                        <select name="service_type" id="service_type" class="w-full px-4 py-2 rounded-lg border dark:border-gray-600 focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white" required onchange="updatePrice()">
                            <option value="standard">Standard</option>
                            <option value="express">Express</option>
                            <option value="overnight">Overnight</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Estimated Price</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 dark:text-gray-400">₹</span>
                            </div>
                            <input type="number" name="price" id="price" step="0.01" min="0" class="w-full pl-8 pr-4 py-2 rounded-lg border dark:border-gray-600 focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white" placeholder="0.00" readonly>
                        </div>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Price will be calculated based on weight and service type</p>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end pt-4">
                    <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-colors duration-200">
                        <i class="fas fa-truck mr-2"></i>Create Shipment
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script>
        // Fill address from saved addresses
        function fillAddress() {
            const savedAddressSelect = document.getElementById('saved_addresses');
            const destinationAddressField = document.getElementById('destination_address');
            destinationAddressField.value = savedAddressSelect.value;
        }

        // Dark mode toggle
        const darkModeToggle = document.getElementById('darkModeToggle');
        if (darkModeToggle) {
            darkModeToggle.addEventListener('click', () => {
                document.body.classList.toggle('dark');
            });
        }

        
        function updatePrice() {
            const weight = parseFloat(document.querySelector('input[name="product_weight"]').value) || 0;
            const serviceType = document.getElementById('service_type').value;
            
            let basePrice = 0;
            if (weight <= 10) {
                basePrice = 1000;
            } else if (weight <= 20) {
                basePrice = 900;
            } else if (weight <= 40) {
                basePrice = 800;
            } else if (weight <= 60) {
                basePrice = 700;
            } else if (weight <= 100) {
                basePrice = 600;
            } else {
                basePrice = 500;
            }
            
            // Apply service type multiplier
            let multiplier = 1;
            switch(serviceType) {
                case 'express':
                    multiplier = 1.5;
                    break;
                case 'overnight':
                    multiplier = 2;
                    break;
                default: // standard
                    multiplier = 1;
            }
            
            // Calculate final price
            const finalPrice = basePrice * weight * multiplier;
            document.getElementById('price').value = finalPrice.toFixed(2);
        }

        // Add event listener for weight input
        document.querySelector('input[name="product_weight"]').addEventListener('input', updatePrice);
    </script>
</body>
</html>