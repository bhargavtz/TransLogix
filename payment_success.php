<?php
session_start();

if (!isset($_SESSION['payment_success'])) {
    header('location: myshipments.php');
    exit;
}

$payment_details = $_SESSION['payment_success'];
unset($_SESSION['payment_success']); // Clear the success message after displaying
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful - TransLogix</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 dark:bg-gray-900">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 dark:bg-green-900">
                    <i class="fas fa-check-circle text-3xl text-green-600 dark:text-green-400"></i>
                </div>
                <h2 class="mt-4 text-3xl font-bold text-gray-900 dark:text-white">Payment Successful!</h2>
                <p class="mt-2 text-gray-600 dark:text-gray-300">Your shipment has been confirmed</p>
            </div>

            <div class="mt-8">
                <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Transaction ID</label>
                        <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white"><?php echo htmlspecialchars($payment_details['transaction_id']); ?></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Amount Paid</label>
                        <p class="mt-1 text-lg font-semibold text-green-600 dark:text-green-400">₹<?php echo number_format($payment_details['amount'], 2); ?></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Tracking Number</label>
                        <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white"><?php echo htmlspecialchars($payment_details['tracking_number']); ?></p>
                    </div>
                </div>

                <div class="mt-8 space-y-4">
                    <a href="tracking.php?tracking_number=<?php echo urlencode($payment_details['tracking_number']); ?>" 
                       class="w-full flex justify-center items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        Track Shipment
                    </a>
                    <a href="myshipments.php" 
                       class="w-full flex justify-center items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none">
                        <i class="fas fa-box mr-2"></i>
                        View All Shipments
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Show confetti animation on page load
        window.onload = function() {
            // Create confetti effect (you can add a confetti library for this)
            console.log("Payment successful!");
        }
    </script>
</body>
</html>