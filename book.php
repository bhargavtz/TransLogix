<?php
session_start();
$isLoggedIn = isset($_SESSION['user']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book & Quote - TransLogix</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-white dark:bg-gray-900 transition-colors duration-200">
    <?php include 'navbar.php'; ?>

    <!-- Booking Hero Section -->
    <section class="pt-24 pb-12 md:pt-32 md:pb-20 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-800 dark:to-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold text-gray-900 dark:text-white mb-6">Book Your Shipment</h1>
                <p class="text-xl text-gray-600 dark:text-gray-300 mb-8">Get instant quotes and book your logistics services with ease</p>
            </div>
        </div>
    </section>

    <!-- Combined Quote and Booking Form Section -->
    <section class="py-16 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Get a Quote & Book Your Service</h2>
                <form id="bookingForm" class="space-y-6" action="payment.php" method="POST">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">From</label>
                            <select id="fromCity" name="fromCity" class="w-full px-4 py-2 rounded-lg border-2 border-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-400 bg-white dark:bg-gray-800 text-gray-900 dark:text-white" required>
                                <option value="">Select City</option>
                                <option value="mumbai">Mumbai</option>
                                <option value="delhi">Delhi</option>
                                <option value="bangalore">Bangalore</option>
                                <option value="kolkata">Kolkata</option>
                                <option value="chennai">Chennai</option>
                                <option value="hyderabad">Hyderabad</option>
                                <option value="pune">Pune</option>
                                <option value="ahmedabad">Ahmedabad</option>
                                <option value="jaipur">Jaipur</option>
                                <option value="lucknow">Lucknow</option>
                                <option value="kanpur">Kanpur</option>
                                <option value="nagpur">Nagpur</option>
                                <option value="indore">Indore</option>
                                <option value="bhopal">Bhopal</option>
                                <option value="patna">Patna</option>
                                <option value="vadodara">Vadodara</option>
                                <option value="ludhiana">Ludhiana</option>
                                <option value="agra">Agra</option>
                                <option value="nashik">Nashik</option>
                                <option value="surat">Surat</option>
                                <option value="coimbatore">Coimbatore</option>
                                <option value="guwahati">Guwahati</option>
                                <option value="visakhapatnam">Visakhapatnam</option>
                                <option value="varanasi">Varanasi</option>
                                <option value="amritsar">Amritsar</option>
                                <option value="meerut">Meerut</option>
                                <option value="rajkot">Rajkot</option>
                                <option value="jodhpur">Jodhpur</option>
                                <option value="madurai">Madurai</option>
                                <option value="allahabad">Allahabad</option>
                                <option value="aurangabad">Aurangabad</option>
                                <option value="mysore">Mysore</option>
                                <option value="hubli">Hubli</option>
                                <option value="gwalior">Gwalior</option>
                                <option value="tirupati">Tirupati</option>
                                <option value="trivandrum">Trivandrum</option>
                                <option value="pondicherry">Pondicherry</option>
                                <option value="ranchi">Ranchi</option>
                                <option value="jamshedpur">Jamshedpur</option>
                                <option value="dehradun">Dehradun</option>
                                <option value="shimla">Shimla</option>
                                <option value="manali">Manali</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">To</label>
                            <select id="toCity" name="toCity" class="w-full px-4 py-2 rounded-lg border-2 border-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-400 bg-white dark:bg-gray-800 text-gray-900 dark:text-white" required>
                                <option value="">Select City</option>
                                <option value="mumbai">Mumbai</option>
                                <option value="delhi">Delhi</option>
                                <option value="bangalore">Bangalore</option>
                                <option value="kolkata">Kolkata</option>
                                <option value="chennai">Chennai</option>
                                <option value="hyderabad">Hyderabad</option>
                                <option value="pune">Pune</option>
                                <option value="ahmedabad">Ahmedabad</option>
                                <option value="jaipur">Jaipur</option>
                                <option value="lucknow">Lucknow</option>
                                <option value="kanpur">Kanpur</option>
                                <option value="nagpur">Nagpur</option>
                                <option value="indore">Indore</option>
                                <option value="bhopal">Bhopal</option>
                                <option value="patna">Patna</option>
                                <option value="vadodara">Vadodara</option>
                                <option value="ludhiana">Ludhiana</option>
                                <option value="agra">Agra</option>
                                <option value="nashik">Nashik</option>
                                <option value="surat">Surat</option>
                                <option value="coimbatore">Coimbatore</option>
                                <option value="guwahati">Guwahati</option>
                                <option value="visakhapatnam">Visakhapatnam</option>
                                <option value="varanasi">Varanasi</option>
                                <option value="amritsar">Amritsar</option>
                                <option value="meerut">Meerut</option>
                                <option value="rajkot">Rajkot</option>
                                <option value="jodhpur">Jodhpur</option>
                                <option value="madurai">Madurai</option>
                                <option value="allahabad">Allahabad</option>
                                <option value="aurangabad">Aurangabad</option>
                                <option value="mysore">Mysore</option>
                                <option value="hubli">Hubli</option>
                                <option value="gwalior">Gwalior</option>
                                <option value="tirupati">Tirupati</option>
                                <option value="trivandrum">Trivandrum</option>
                                <option value="pondicherry">Pondicherry</option>
                                <option value="ranchi">Ranchi</option>
                                <option value="jamshedpur">Jamshedpur</option>
                                <option value="dehradun">Dehradun</option>
                                <option value="shimla">Shimla</option>
                                <option value="manali">Manali</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Name</label>
                            <input type="text" id="name" name="name" class="w-full px-4 py-2 rounded-lg border-2 border-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-400 bg-white dark:bg-gray-800 text-gray-900 dark:text-white" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label>
                            <input type="email" id="email" name="email" class="w-full px-4 py-2 rounded-lg border-2 border-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-400 bg-white dark:bg-gray-800 text-gray-900 dark:text-white" required>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Phone</label>
                            <input type="tel" id="phone" name="phone" class="w-full px-4 py-2 rounded-lg border-2 border-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-400 bg-white dark:bg-gray-800 text-gray-900 dark:text-white" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Weight (KG)</label>
                            <input type="number" id="weight" name="weight" class="w-full px-4 py-2 rounded-lg border-2 border-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-400 bg-white dark:bg-gray-800 text-gray-900 dark:text-white" required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Product Type</label>
                        <select id="productType" name="productType" class="w-full px-4 py-2 rounded-lg border-2 border-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-400 bg-white dark:bg-gray-800 text-gray-900 dark:text-white" required>
                            <option value="">Select Product Type</option>
                            <option value="fragile">Fragile</option>
                            <option value="perishable">Perishable</option>
                            <option value="electronics">Electronics</option>
                            <option value="clothing">Clothing</option>
                            <option value="furniture">Furniture</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pickup Address</label>
                        <textarea id="pickupAddress" name="pickupAddress" class="w-full px-4 py-2 rounded-lg border-2 border-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-400 bg-white dark:bg-gray-800 text-gray-900 dark:text-white" rows="3" required></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Delivery Address</label>
                        <textarea id="deliveryAddress" name="deliveryAddress" class="w-full px-4 py-2 rounded-lg border-2 border-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-400 bg-white dark:bg-gray-800 text-gray-900 dark:text-white" rows="3" required></textarea>
                    </div>
                    <div id="quoteResult" class="hidden mt-6 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Estimated Quote</h3>
                        <p class="text-3xl font-bold text-blue-600 dark:text-blue-400">₹<span id="quoteAmount">0</span></p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">*This is an estimated quote. Final price may vary based on additional services and requirements.</p>
                        <input type="hidden" id="price" name="price" value="0">
                    </div>
                    <button type="button" id="calculateQuote" class="w-full px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">Calculate Quote</button>
                    <button type="submit" class="w-full px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-300">Book Now</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Rules and Regulations Section -->
    <section class="py-16 bg-gray-50 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">Rules and Regulations</h2>
                <p class="text-lg text-gray-600 dark:text-gray-300 mt-4">Understand our pricing structure and guidelines for booking shipments.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Pricing Table -->
                <div class="bg-white dark:bg-gray-700 rounded-lg shadow-lg p-6">
                    <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">Pricing Based on Weight</h3>
                    <table class="table-auto w-full border-collapse border border-gray-300">
                        <thead>
                            <tr>
                                <th class="border border-gray-300 px-4 py-2">Weight Range (KG)</th>
                                <th class="border border-gray-300 px-4 py-2">Price (₹)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">0 - 10</td>
                                <td class="border border-gray-300 px-4 py-2">₹1,000 per KG</td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">11 - 20</td>
                                <td class="border border-gray-300 px-4 py-2">₹900 per KG</td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">21 - 40</td>
                                <td class="border border-gray-300 px-4 py-2">₹800 per KG</td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">41 - 60</td>
                                <td class="border border-gray-300 px-4 py-2">₹700 per KG</td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">61 - 100</td>
                                <td class="border border-gray-300 px-4 py-2">₹600 per KG</td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">Above 100</td>
                                <td class="border border-gray-300 px-4 py-2">₹500 per KG</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Guidelines -->
                <div class="bg-white dark:bg-gray-700 rounded-lg shadow-lg p-6">
                    <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">Important Guidelines</h3>
                    <ul class="list-disc list-inside text-gray-600 dark:text-gray-300 space-y-4">
                        <li>Ensure accurate weight and dimensions are provided during booking.</li>
                        <li>Additional charges may apply for special handling or fragile items.</li>
                        <li>Insurance options are available for high-value shipments.</li>
                        <li>Delivery timelines depend on the selected service type and destination.</li>
                        <li>Contact our support team for any queries or assistance.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>

    <script>
        const calculateQuoteButton = document.getElementById('calculateQuote');
        const quoteResult = document.getElementById('quoteResult');
        const quoteAmount = document.getElementById('quoteAmount');
        const bookingForm = document.getElementById('bookingForm');

        calculateQuoteButton.addEventListener('click', () => {
            const weight = parseFloat(document.getElementById('weight').value);

            if (!weight) {
                alert('Please enter a valid weight.');
                return;
            }

            // Dynamic pricing logic
            let pricePerKg;
            if (weight <= 10) {
                pricePerKg = 1000; // ₹1,000 per KG for up to 10 KG
            } else if (weight <= 20) {
                pricePerKg = 900; // ₹900 per KG for 11-20 KG
            } else if (weight <= 40) {
                pricePerKg = 800; // ₹800 per KG for 21-40 KG
            } else if (weight <= 60) {
                pricePerKg = 700; // ₹700 per KG for 41-60 KG
            } else if (weight <= 100) {
                pricePerKg = 600; // ₹600 per KG for 61-100 KG
            } else {
                pricePerKg = 500; // ₹500 per KG for above 100 KG
            }

            const totalPrice = weight * pricePerKg;
            quoteAmount.textContent = totalPrice.toLocaleString();
            document.getElementById('price').value = totalPrice;
            quoteResult.classList.remove('hidden');
        });

        bookingForm.addEventListener('submit', (e) => {
            e.preventDefault();
            alert('Thank you for your booking. We will contact you shortly to confirm the details.');
            bookingForm.reset();
            quoteResult.classList.add('hidden');
        });
    </script>
</body>
</html>
