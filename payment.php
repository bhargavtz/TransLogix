<?php
session_start();

// Fetch booking details from session or POST data
$email = $_SESSION['email'] ?? $_POST['email'] ?? '';
$phone = $_SESSION['phone'] ?? $_POST['phone'] ?? '';
$price = $_SESSION['price'] ?? $_POST['price'] ?? '';

// If booking details are missing, redirect to the booking page
if (empty($email) || empty($phone) || empty($price)) {
    header('Location: book.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - TransLogix</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 dark:bg-gray-900">
    <?php include 'navbar.php'; ?>

    <!-- Payment Section -->
    <section class="py-16 bg-white dark:bg-gray-900">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Complete Your Payment</h2>
                <div class="space-y-6">
                    <!-- Booking Details -->
                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Booking Details</h3>
                        <p class="text-gray-600 dark:text-gray-300"><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
                        <p class="text-gray-600 dark:text-gray-300"><strong>Phone:</strong> <?php echo htmlspecialchars($phone); ?></p>
                        <p class="text-gray-600 dark:text-gray-300"><strong>Price:</strong> ₹<?php echo htmlspecialchars($price); ?></p>
                    </div>

                    <!-- Payment Options -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Select Payment Method</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <button class="payment-option bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow hover:bg-gray-100 dark:hover:bg-gray-600 transition">
                                <i class="fas fa-university text-3xl text-blue-600 dark:text-blue-400 mb-2"></i>
                                <p class="text-gray-900 dark:text-white">Net Banking</p>
                            </button>
                            <button class="payment-option bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow hover:bg-gray-100 dark:hover:bg-gray-600 transition">
                                <i class="fas fa-credit-card text-3xl text-blue-600 dark:text-blue-400 mb-2"></i>
                                <p class="text-gray-900 dark:text-white">Credit/Debit Card</p>
                            </button>
                            <button class="payment-option bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow hover:bg-gray-100 dark:hover:bg-gray-600 transition">
                                <i class="fas fa-mobile-alt text-3xl text-blue-600 dark:text-blue-400 mb-2"></i>
                                <p class="text-gray-900 dark:text-white">UPI</p>
                            </button>
                        </div>
                    </div>

                    <!-- Payment Button -->
                    <button id="payNow" class="w-full px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">
                        Pay ₹<?php echo htmlspecialchars($price); ?>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <script>
        document.getElementById('payNow').addEventListener('click', function () {
            // Simulate real-time payment processing
            swal({
                title: "Processing Payment",
                text: "Please wait while we process your payment...",
                icon: "info",
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false,
                timer: 3000
            }).then(() => {
                // Simulate successful payment
                swal({
                    title: "Payment Successful!",
                    text: "Your payment of ₹<?php echo htmlspecialchars($price); ?> has been completed successfully.",
                    icon: "success",
                    button: "OK"
                }).then(() => {
                    // Redirect to a success page or dashboard
                    window.location.href = "dashboard.php";
                });

                // Simulate real-time notification (e.g., push notification)
                if (Notification.permission === "granted") {
                    new Notification("Payment Successful", {
                        body: "Your payment of ₹<?php echo htmlspecialchars($price); ?> has been completed successfully.",
                        icon: "https://cdn-icons-png.flaticon.com/512/190/190411.png"
                    });
                } else if (Notification.permission !== "denied") {
                    Notification.requestPermission().then(permission => {
                        if (permission === "granted") {
                            new Notification("Payment Successful", {
                                body: "Your payment of ₹<?php echo htmlspecialchars($price); ?> has been completed successfully.",
                                icon: "https://cdn-icons-png.flaticon.com/512/190/190411.png"
                            });
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
