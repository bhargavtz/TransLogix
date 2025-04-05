<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('location: login.php');
    exit;
}

require_once 'config.php';

$user_id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
if ($user_id === 0) {
    header('location: login.php');
    exit;
}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Shipment - TransLogix</title>
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
                    <i class="fas fa-user-shield mr-3"></i>
                    Admin
                </a>
                <a href="/TransLogix/myshipments.php" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                    <i class="fas fa-box mr-3"></i>
                    My Shipments
                </a>
                <a href="/TransLogix/invoices.php" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                    <i class="fas fa-file-invoice mr-3"></i>
                    Invoices
                </a>
                <a href="/TransLogix/saved-addresses.php" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                    <i class="fas fa-map-marker-alt mr-3"></i>
                    Saved Addresses
                </a>
                <a href="/TransLogix/order-history.php" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                    <i class="fas fa-history mr-3"></i>
                    Order History
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
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Create New Shipment</h1>
                <p class="text-gray-600 dark:text-gray-300">Fill in the details below to create a new shipment</p>
            </div>
            <div class="flex items-center space-x-4">
                <button id="darkModeToggle" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700">
                    <i class="fas fa-moon dark:hidden"></i>
                    <i class="fas fa-sun hidden dark:block text-yellow-400"></i>
                </button>
                <div class="relative" x-data="{ isOpen: false }">
                    <button @click="isOpen = !isOpen" class="flex items-center space-x-2 focus:outline-none">
                        <img src="https://via.placeholder.com/40" alt="Profile" class="w-10 h-10 rounded-full">
                        <span class="text-gray-700 dark:text-white"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div x-show="isOpen" @click.away="isOpen = false" class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg py-1 z-50">
                        <a href="/TransLogix/profile.php" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <i class="fas fa-user mr-2"></i> Profile
                        </a>
                        <a href="profile.php#settings" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <i class="fas fa-cog mr-2"></i> Settings
                        </a>
                        <hr class="border-gray-200 dark:border-gray-700">
                        <a href="logout.php" class="block px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Shipment Form -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
            <?php if ($success_message): ?>
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    <?php echo $success_message; ?>
                </div>
            <?php endif; ?>
            <?php if ($error_message): ?>
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-6">
                <!-- Sender Address -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Sender Address</label>
                        <select name="sender_address" required class="w-full px-4 py-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select sender address</option>
                            <?php foreach (getUserAddresses($user_id) as $address): ?>
                                <option value="<?php echo $address['id']; ?>">
                                    <?php echo htmlspecialchars($address['street'] . ', ' . $address['city'] . ', ' . $address['state']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Receiver Address -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Receiver Address</label>
                        <select name="receiver_address" required class="w-full px-4 py-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select receiver address</option>
                            <?php foreach (getUserAddresses($user_id) as $address): ?>
                                <option value="<?php echo $address['id']; ?>">
                                    <?php echo htmlspecialchars($address['street'] . ', ' . $address['city'] . ', ' . $address['state']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- Package Details -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Package Type</label>
                        <select name="package_type" required class="w-full px-4 py-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select package type</option>
                            <option value="document">Document</option>
                            <option value="parcel">Parcel</option>
                            <option value="fragile">Fragile</option>
                            <option value="heavy">Heavy</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Weight (kg)</label>
                        <input type="number" name="weight" required step="0.01" min="0.01" class="w-full px-4 py-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Dimensions (LxWxH cm)</label>
                        <input type="text" name="dimensions" placeholder="30x20x10" class="w-full px-4 py-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <!-- Shipping Method -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Shipping Method</label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <?php foreach (getShippingMethods() as $method): ?>
                            <div class="border rounded-lg p-4 cursor-pointer hover:border-blue-500 dark:border-gray-600 dark:hover:border-blue-400">
                                <input type="radio" name="shipping_method" value="<?php echo $method['id']; ?>" required class="hidden peer" id="method_<?php echo $method['id']; ?>">
                                <label for="method_<?php echo $method['id']; ?>" class="block cursor-pointer">
                                    <div class="font-medium text-gray-900 dark:text-white"><?php echo htmlspecialchars($method['name']); ?></div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400"><?php echo htmlspecialchars($method['description']); ?></div>
                                    <div class="mt-2 text-blue-600 dark:text-blue-400">₹<?php echo number_format($method['base_cost'], 2); ?> + ₹<?php echo number_format($method['cost_per_kg'], 2); ?>/kg</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">Estimated delivery: <?php echo htmlspecialchars($method['estimated_days']); ?></div>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" name="create_shipment" class="px-6 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <i class="fas fa-box mr-2"></i>Create Shipment
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script>
        // Dark mode toggle
        const darkModeToggle = document.getElementById('darkModeToggle');
        darkModeToggle.addEventListener('click', () => {
            document.body.classList.toggle('dark');
            localStorage.setItem('darkMode', document.body.classList.contains('dark'));
        });

        // Check for saved dark mode preference
        if (localStorage.getItem('darkMode') === 'true') {
            document.body.classList.add('dark');
        }

        // GSAP animations
        gsap.from('.quick-action', {
            duration: 0.6,
            y: 20,
            opacity: 0,
            stagger: 0.2,
            ease: 'power2.out'
        });
    </script>
</body>
</html>

<?php
// Get user's saved addresses
function getUserAddresses($userId) {
    global $conn;
    $sql = "SELECT * FROM user_addresses WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $addresses = [];
    while($row = $result->fetch_assoc()) {
        $addresses[] = $row;
    }
    return $addresses;
}

// Get shipping methods
function getShippingMethods() {
    global $conn;
    $sql = "SELECT * FROM shipping_methods";
    $result = $conn->query($sql);
    $methods = [];
    while($row = $result->fetch_assoc()) {
        $methods[] = $row;
    }
    return $methods;
}

// Generate tracking number
function generateTrackingNumber() {
    return 'TL' . date('Y') . rand(100000, 999999);
}

$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_shipment'])) {
    $sender_address_id = $_POST['sender_address'];
    $receiver_address_id = $_POST['receiver_address'];
    $package_type = $_POST['package_type'];
    $weight = $_POST['weight'];
    $dimensions = $_POST['dimensions'];
    $shipping_method = $_POST['shipping_method'];
    
    // Calculate shipping cost based on weight and shipping method
    $sql = "SELECT base_cost, cost_per_kg FROM shipping_methods WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $shipping_method);
    $stmt->execute();
    $result = $stmt->get_result();
    $method = $result->fetch_assoc();
    
    $shipping_cost = $method['base_cost'] + ($method['cost_per_kg'] * $weight);
    $tracking_number = generateTrackingNumber();
    
    $sql = "INSERT INTO shipments (user_id, tracking_number, sender_address_id, receiver_address_id, 
            package_type, weight, dimensions, shipping_method, shipping_cost, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending')";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issiisddd", $user_id, $tracking_number, $sender_address_id, $receiver_address_id, 
                      $package_type, $weight, $dimensions, $shipping_method, $shipping_cost);
    
    if ($stmt->execute()) {
        $success_message = "Shipment created successfully! Tracking number: " . $tracking_number;
    } else {
        $error_message = "Error creating shipment: " . $conn->error;
    }
}

$addresses = getUserAddresses($user_id);
$shipping_methods = getShippingMethods();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Shipment - TransLogix</title>
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
                    <i class="fas fa-user-shield mr-3"></i>
                    Admin
                </a>
                <a href="/TransLogix/myshipments.php" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                    <i class="fas fa-box mr-3"></i>
                    My Shipments
                </a>
                <a href="/TransLogix/invoices.php" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                    <i class="fas fa-file-invoice mr-3"></i>
                    Invoices
                </a>
                <a href="/TransLogix/saved-addresses.php" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                    <i class="fas fa-map-marker-alt mr-3"></i>
                    Saved Addresses
                </a>
                <a href="/TransLogix/order-history.php" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                    <i class="fas fa-history mr-3"></i>
                    Order History
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
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Create New Shipment</h1>
                <p class="text-gray-600 dark:text-gray-300">Fill in the details to create a new shipping order</p>
            </div>
            <div class="flex items-center space-x-4">
                <button id="darkModeToggle" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700">
                    <i class="fas fa-moon dark:hidden"></i>
                    <i class="fas fa-sun hidden dark:block text-yellow-400"></i>
                </button>
                <div class="relative" x-data="{ isOpen: false }">
                    <button @click="isOpen = !isOpen" class="flex items-center space-x-2 focus:outline-none">
                        <img src="https://via.placeholder.com/40" alt="Profile" class="w-10 h-10 rounded-full">
                        <span class="text-gray-700 dark:text-white"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div x-show="isOpen" @click.away="isOpen = false" class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg py-1 z-50">
                        <a href="/TransLogix/profile.php" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <i class="fas fa-user mr-2"></i> Profile
                        </a>
                        <a href="profile.php#settings" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <i class="fas fa-cog mr-2"></i> Settings
                        </a>
                        <hr class="border-gray-200 dark:border-gray-700">
                        <a href="logout.php" class="block px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <?php if (isset($success_message)): ?>
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                <p><?php echo $success_message; ?></p>
            </div>
        <?php endif; ?>
        
        <?php if (isset($error_message)): ?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                <p><?php echo $error_message; ?></p>
            </div>
        <?php endif; ?>

        <!-- Shipment Form -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <form method="POST" action="" class="space-y-6">
                <!-- Addresses Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Sender Address -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Sender Address</label>
                        <select name="sender_address" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            <option value="">Select sender address</option>
                            <?php foreach ($addresses as $address): ?>
                                <option value="<?php echo $address['id']; ?>">
                                    <?php echo htmlspecialchars($address['address_type'] . ' - ' . $address['street'] . ', ' . $address['city']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Receiver Address -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Receiver Address</label>
                        <select name="receiver_address" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            <option value="">Select receiver address</option>
                            <?php foreach ($addresses as $address): ?>
                                <option value="<?php echo $address['id']; ?>">
                                    <?php echo htmlspecialchars($address['address_type'] . ' - ' . $address['street'] . ', ' . $address['city']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- Package Details Section -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Package Type</label>
                        <select name="package_type" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            <option value="">Select package type</option>
                            <option value="Document">Document</option>
                            <option value="Small Package">Small Package</option>
                            <option value="Medium Box">Medium Box</option>
                            <option value="Large Box">Large Box</option>
                            <option value="Extra Large">Extra Large</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Weight (kg)</label>
                        <input type="number" name="weight" step="0.01" min="0.1" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Dimensions (L x W x H cm)</label>
                        <input type="text" name="dimensions" placeholder="30x20x10" pattern="\d+x\d+x\d+" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                    </div>
                </div>

                <!-- Shipping Method Section -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Shipping Method</label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <?php foreach ($shipping_methods as $method): ?>
                            <div class="relative">
                                <input type="radio" name="shipping_method" value="<?php echo $method['id']; ?>" 
                                       id="method_<?php echo $method['id']; ?>" class="peer hidden" required>
                                <label for="method_<?php echo $method['id']; ?>" 
                                       class="block p-4 bg-white dark:bg-gray-700 border rounded-lg cursor-pointer
                                              peer-checked:border-blue-500 peer-checked:ring-2 peer-checked:ring-blue-500">
                                    <h3 class="font-semibold text-gray-900 dark:text-white"><?php echo htmlspecialchars($method['name']); ?></h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400"><?php echo htmlspecialchars($method['description']); ?></p>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-300">
                                        Base: $<?php echo number_format($method['base_cost'], 2); ?><br>
                                        Per kg: $<?php echo number_format($method['cost_per_kg'], 2); ?>
                                    </p>
                                    <p class="mt-1 text-sm font-medium text-blue-600 dark:text-blue-400">
                                        <?php echo htmlspecialchars($method['estimated_days']); ?>
                                    </p>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" name="create_shipment" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
                        <i class="fas fa-box mr-2"></i>Create Shipment
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script>
        // Dark mode toggle
        const darkModeToggle = document.getElementById('darkModeToggle');
        const html = document.documentElement;
    
        darkModeToggle.addEventListener('click', () => {
            html.classList.toggle('dark');
            localStorage.setItem('darkMode', html.classList.contains('dark'));
        });
    
        // Check for saved dark mode preference
        if (localStorage.getItem('darkMode') === 'true') {
            html.classList.add('dark');
        }
    
        // GSAP Animations
        gsap.from('.address-card', {
            opacity: 0,
            y: 20,
            duration: 0.6,
            stagger: 0.1,
            ease: 'power2.out'
        });
    </script>
</body>
</html>