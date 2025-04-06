<?php
session_start();
require_once '../config.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../login.php');
    exit();
}

// Delete message if requested
if (isset($_GET['delete'])) {
    $messageId = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM contact_messages WHERE id = ?");
    $stmt->bind_param("i", $messageId);
    $stmt->execute();
    header('Location: messages.php');
    exit();
}

// Fetch all messages
$stmt = $conn->prepare("SELECT * FROM contact_messages ORDER BY created_at DESC");
$stmt->execute();
$result = $stmt->get_result();
$messages = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-blue-600 text-white p-6">
            <h2 class="text-2xl font-bold mb-8">TransLogix Admin</h2>
            <nav>
                <a href="dashboard.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 mb-1">
                    <i class="fas fa-home mr-2"></i>Dashboard
                </a>
                <a href="shipments.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 mb-1">
                    <i class="fas fa-truck mr-2"></i>Shipments
                </a>
                <a href="manage-users.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 mb-1">
                    <i class="fas fa-users mr-2"></i>Users
                </a>
                <a href="messages.php" class="block py-2.5 px-4 rounded transition duration-200 bg-blue-700 mb-1">
                    <i class="fas fa-envelope mr-2"></i>Messages
                </a>
                <a href="reports.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 mb-1">
                    <i class="fas fa-chart-bar mr-2"></i>Reports
                </a>
                <a href="settings.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 mb-1">
                    <i class="fas fa-cog mr-2"></i>Settings
                </a>
                <a href="logout.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 mt-8 text-red-300">
                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Messages</h1>
            </div>

            <!-- Messages Table -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Message</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($messages as $message): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($message['name']); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($message['email']); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($message['subject']); ?></td>
                            <td class="px-6 py-4">
                                <div class="max-w-xs overflow-hidden text-ellipsis">
                                    <?php echo htmlspecialchars($message['message']); ?>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo date('Y-m-d H:i', strtotime($message['created_at'])); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="?delete=<?php echo $message['id']; ?>" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this message?')">
                                    Delete
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>