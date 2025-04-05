<?php
require_once 'config.php';
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('location: login.php');
    exit;
}
$user_id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
if ($user_id === 0) {
    header('location: login.php');
    exit;
}
function addUserAddress($userId, $addressType, $street, $apartment, $city, $state, $pincode, $phone) {
    global $conn;
    $sql = "INSERT INTO user_addresses (user_id, address_type, street, apartment, city, state, pincode, phone) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssssss", $userId, $addressType, $street, $apartment, $city, $state, $pincode, $phone);
    return $stmt->execute();
}
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
function deleteUserAddress($addressId, $userId) {
    global $conn;
    $sql = "DELETE FROM user_addresses WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $addressId, $userId);
    return $stmt->execute();
}
// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_address'])) {
        $addressType = $_POST['address_type'];
        $street = $_POST['street'];
        $apartment = $_POST['apartment'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $pincode = $_POST['pincode'];
        $phone = $_POST['phone'];

        // Validate phone number
        if (!preg_match('/^\d{10}$/', $phone)) {
            $error_message = "Phone number must be exactly 10 digits.";
        } else {
            if (addUserAddress($user_id, $addressType, $street, $apartment, $city, $state, $pincode, $phone)) {
                $success_message = "Address added successfully!";
            } else {
                $error_message = "Failed to add address.";
            }
        }
    } elseif (isset($_POST['delete_address'])) {
        $addressId = $_POST['address_id'];
        if (deleteUserAddress($addressId, $user_id)) {
            $success_message = "Address deleted successfully!";
        } else {
            $error_message = "Failed to delete address.";
        }
    }
}
// Get user's saved addresses
$addresses = getUserAddresses($user_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saved Addresses - TransLogix</title>
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
                <a href="/TransLogix/saved-addresses.php" class="flex items-center px-4 py-3 text-gray-700 dark:text-white bg-gray-100 dark:bg-gray-700 rounded-lg">
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
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Saved Addresses</h1>
                <p class="text-gray-600 dark:text-gray-300">Manage your delivery and pickup locations</p>
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
        <!-- Add New Address Form -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Add New Address</h2>
            <form method="POST" action="" class="space-y-4" onsubmit="return validateForm()">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="address_type">Address Type</label>
                        <select class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" id="address_type" name="address_type" required>
                            <option value="Home">Home</option>
                            <option value="Office">Office</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="phone">Phone Number</label>
                        <input type="tel" pattern="\d{10}" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" id="phone" name="phone" required>
                        <small class="text-gray-500 dark:text-gray-400">Please enter a 10-digit phone number.</small>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="street">Street Address</label>
                    <input type="text" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" id="street" name="street" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="apartment">Apartment/Suite/Unit</label>
                    <input type="text" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" id="apartment" name="apartment">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="city">City</label>
                        <input type="text" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" id="city" name="city" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="state">State</label>
                        <input type="text" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" id="state" name="state" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="pincode">Pincode</label>
                        <input type="text" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" id="pincode" name="pincode" required>
                    </div>
                </div>
                <button type="submit" name="add_address" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
                    <i class="fas fa-plus mr-2"></i>Add Address
                </button>
            </form>
        </div>
        <!-- Saved Addresses -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Your Saved Addresses</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php foreach ($addresses as $address): ?>
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 relative address-card">
                    <div class="flex justify-between items-start mb-4">
                        <span class="inline-block px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded-full text-sm font-semibold">
                            <?php echo htmlspecialchars($address['address_type']); ?>
                        </span>
                        <form method="POST" class="inline">
                            <input type="hidden" name="address_id" value="<?php echo $address['id']; ?>">
                            <button type="submit" name="delete_address" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300" 
                                    onclick="return confirm('Are you sure you want to delete this address?')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                    <div class="text-gray-700 dark:text-gray-300 space-y-2">
                        <p><?php echo htmlspecialchars($address['street']); ?></p>
                        <?php if (!empty($address['apartment'])): ?>
                            <p><?php echo htmlspecialchars($address['apartment']); ?></p>
                        <?php endif; ?>
                        <p>
                            <?php echo htmlspecialchars($address['city']); ?>, 
                            <?php echo htmlspecialchars($address['state']); ?> - 
                            <?php echo htmlspecialchars($address['pincode']); ?>
                        </p>
                        <p class="flex items-center">
                            <i class="fas fa-phone mr-2"></i>
                            <?php echo htmlspecialchars($address['phone']); ?>
                        </p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
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

        // Form validation
        function validateForm() {
            const phoneInput = document.getElementById('phone');
            const phoneValue = phoneInput.value.trim();
            const phonePattern = /^\d{10}$/;

            if (!phonePattern.test(phoneValue)) {
                alert('Please enter a valid 10-digit phone number.');
                return false;
            }
            return true;
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