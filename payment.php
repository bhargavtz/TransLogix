<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cardNumber = $_POST['card_number'] ?? '';
    $expiryDate = $_POST['expiry_date'] ?? '';
    $cvv = $_POST['cvv'] ?? '';
    $upi = $_POST['upi'] ?? '';

    if (!empty($cardNumber) && !empty($expiryDate) && !empty($cvv)) {
        // Simulate payment processing
        $paymentSuccess = true; 
        if ($paymentSuccess) {
            echo "<script>alert('Payment successful!');</script>";
        } else {
            echo "<script>alert('Payment failed. Please try again.');</script>";
        }
    } elseif (!empty($upi)) {
        
        $upiSuccess = true; 
        if ($upiSuccess) {
            echo "<script>alert('UPI payment successful!');</script>";
        } else {
            echo "<script>alert('UPI payment failed. Please try again.');</script>";
        }
    } else {
        echo "<script>alert('Please fill in all payment details.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Payment Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .payment-card {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .payment-card:hover {
            transform: translateY(-5px);
        }
        .input-field {
            border: 1px solid #e2e8f0;
            transition: border-color 0.3s ease;
        }
        .input-field:focus {
            border-color: #4299e1;
            outline: none;
        }
        .btn-primary {
            background: linear-gradient(135deg, #4361ee, #3f37c9);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(67, 97, 238, 0.3);
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen py-10">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto bg-white rounded-xl payment-card p-8">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-gray-800">Secure Payment</h1>
                <p class="text-gray-600">Enter your payment details to proceed</p>
            </div>

            <form method="post">
                <div class="mb-6">
                    <label for="card_number" class="block text-sm font-medium text-gray-700 mb-1">Card Number</label>
                    <input
                        type="text"
                        id="card_number"
                        name="card_number"
                        class="input-field w-full px-3 py-2 rounded-md"
                        placeholder="4242 4242 4242 4242"
                        required
                    >
                </div>

                <div class="flex gap-4 mb-6">
                    <div class="w-1/2">
                        <label for="expiry_date" class="block text-sm font-medium text-gray-700 mb-1">Expiry Date</label>
                        <input
                            type="text"
                            id="expiry_date"
                            name="expiry_date"
                            class="input-field w-full px-3 py-2 rounded-md"
                            placeholder="MM/YY"
                            required
                        >
                    </div>
                    <div class="w-1/2">
                        <label for="cvv" class="block text-sm font-medium text-gray-700 mb-1">CVV</label>
                        <input
                            type="text"
                            id="cvv"
                            name="cvv"
                            class="input-field w-full px-3 py-2 rounded-md"
                            placeholder="123"
                            required
                        >
                    </div>
                </div>

                <div class="mb-6">
                    <label for="upi" class="block text-sm font-medium text-gray-700 mb-1">UPI ID (Optional)</label>
                    <input
                        type="text"
                        id="upi"
                        name="upi"
                        class="input-field w-full px-3 py-2 rounded-md"
                        placeholder="example@upi"
                    >
                </div>

                <div class="text-center">
                    <button
                        type="submit"
                        class="btn-primary w-full px-4 py-3 rounded-md text-white font-medium"
                    >
                        Proceed to Payment
                    </button>
                </div>
            </form>
        </div>

        <div class="text-center mt-8 text-gray-600 text-sm">
            <p>By proceeding, you agree to our <a href="#" class="text-blue-500 hover:text-blue-700">Terms of Service</a> and <a href="#" class="text-blue-500 hover:text-blue-700">Privacy Policy</a></p>
        </div>
    </div>
</body>
</html>