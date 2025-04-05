<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    header('location: ../login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT username, email, phone_number FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($username, $email, $phone_number);
    $stmt->fetch();
    $stmt->close();
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phone_number = trim($_POST['phone_number']);

    $sql = "UPDATE users SET username = ?, email = ?, phone_number = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $username, $email, $phone_number, $id);
    if ($stmt->execute()) {
        header('location: manage-users.php');
        exit;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - TransLogix</title>
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
            <h2 class="text-xl font-bold text-gray-900 dark:text-white">Admin Dashboard</h2>
        </div>
        <nav class="mt-6">
            <div class="px-4 space-y-2">
                <a href="dashboard.php" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>
                <a href="manage-users.php" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                    <i class="fas fa-users mr-3"></i>
                    User Management
                </a>
                <a href="shipments.php" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                    <i class="fas fa-box mr-3"></i>
                    Shipments
                </a>
                <a href="reports.php" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                    <i class="fas fa-chart-line mr-3"></i>
                    Reports
                </a>
                <a href="settings.php" class="flex items-center px-4 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                    <i class="fas fa-cog mr-3"></i>
                    Settings
                </a>
            </div>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="ml-64 p-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Edit User</h1>
            <form action="edit-user.php" method="post" class="space-y-4">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div>
                    <label class="block text-gray-700 dark:text-gray-300">Username</label>
                    <input type="text" name="username" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white" value="<?php echo htmlspecialchars($username); ?>" required>
                </div>
                <div>
                    <label class="block text-gray-700 dark:text-gray-300">Email</label>
                    <input type="email" name="email" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white" value="<?php echo htmlspecialchars($email); ?>" required>
                </div>
                <div>
                    <label class="block text-gray-700 dark:text-gray-300">Phone Number</label>
                    <input type="tel" name="phone_number" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white" value="<?php echo htmlspecialchars($phone_number); ?>" required>
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Save Changes</button>
                    <a href="manage-users.php" class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">Cancel</a>
                </div>
            </form>
        </div>
    </main>

    <script>
        // GSAP Animations
        gsap.from('form', {
            opacity: 0,
            y: 20,
            duration: 0.6,
            ease: 'power2.out'
        });
    </script>
</body>
</html>
