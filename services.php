<?php
$pageTitle = 'Services';
require_once 'includes/header.php';
?>
<?php include 'navigation.php'; ?>
<!-- Hero Section -->
<section class="pt-32 pb-16 px-4 bg-gradient-to-br from-blue-50 to-white dark:from-gray-800 dark:to-gray-900">
    <div class="max-w-7xl mx-auto text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-6">Our Logistics Services</h1>
        <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">Delivering excellence through comprehensive logistics solutions tailored to your business needs.</p>
    </div>
</section>

<!-- Services Grid -->
<section class="py-16 px-4">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Freight Transport -->
        <div class="service-card bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 transform hover:-translate-y-2 transition-all duration-300">
            <div class="text-blue-600 dark:text-blue-400 mb-4">
                <i class="fas fa-truck text-4xl"></i>
            </div>
            <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">Freight Transport</h3>
            <p class="text-gray-600 dark:text-gray-300">Efficient and reliable freight transportation services across land, sea, and air, ensuring your cargo reaches its destination safely and on time.</p>
        </div>

        <!-- Warehousing -->
        <div class="service-card bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 transform hover:-translate-y-2 transition-all duration-300">
            <div class="text-blue-600 dark:text-blue-400 mb-4">
                <i class="fas fa-warehouse text-4xl"></i>
            </div>
            <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">Warehousing</h3>
            <p class="text-gray-600 dark:text-gray-300">State-of-the-art warehousing facilities with advanced inventory management systems and security measures for safe storage of your goods.</p>
        </div>

        <!-- Supply Chain Solutions -->
        <div class="service-card bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 transform hover:-translate-y-2 transition-all duration-300">
            <div class="text-blue-600 dark:text-blue-400 mb-4">
                <i class="fas fa-link text-4xl"></i>
            </div>
            <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">Supply Chain Solutions</h3>
            <p class="text-gray-600 dark:text-gray-300">End-to-end supply chain management solutions optimized for efficiency, visibility, and cost-effectiveness.</p>
        </div>

        <!-- Express Delivery -->
        <div class="service-card bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 transform hover:-translate-y-2 transition-all duration-300">
            <div class="text-blue-600 dark:text-blue-400 mb-4">
                <i class="fas fa-shipping-fast text-4xl"></i>
            </div>
            <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">Express Delivery</h3>
            <p class="text-gray-600 dark:text-gray-300">Fast and reliable express delivery services for time-sensitive shipments with real-time tracking capabilities.</p>
        </div>

        <!-- Customs Clearance -->
        <div class="service-card bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 transform hover:-translate-y-2 transition-all duration-300">
            <div class="text-blue-600 dark:text-blue-400 mb-4">
                <i class="fas fa-passport text-4xl"></i>
            </div>
            <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">Customs Clearance</h3>
            <p class="text-gray-600 dark:text-gray-300">Expert customs clearance services ensuring smooth international shipping with complete documentation and compliance.</p>
        </div>

        <!-- Specialized Transport -->
        <div class="service-card bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 transform hover:-translate-y-2 transition-all duration-300">
            <div class="text-blue-600 dark:text-blue-400 mb-4">
                <i class="fas fa-box-open text-4xl"></i>
            </div>
            <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">Specialized Transport</h3>
            <p class="text-gray-600 dark:text-gray-300">Specialized transportation solutions for oversized, fragile, or temperature-sensitive cargo with expert handling.</p>
        </div>
    </div>
</section>

<!-- Services Table -->
<section class="py-16 px-4">
    <div class="max-w-7xl mx-auto">
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Service Name</th>
                    <th class="border border-gray-300 px-4 py-2">Description</th>
                    <th class="border border-gray-300 px-4 py-2">Price</th>
                    <th class="border border-gray-300 px-4 py-2">Additional Features</th> <!-- New field -->
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border border-gray-300 px-4 py-2">Air Freight</td>
                    <td class="border border-gray-300 px-4 py-2">Fast and secure air freight services for time-sensitive shipments.</td>
                    <td class="border border-gray-300 px-4 py-2">₹50/KG</td>
                    <td class="border border-gray-300 px-4 py-2">Priority handling, real-time tracking</td> <!-- Example data -->
                </tr>
                <tr>
                    <td class="border border-gray-300 px-4 py-2">Sea Freight</td>
                    <td class="border border-gray-300 px-4 py-2">Comprehensive ocean freight services for global shipping.</td>
                    <td class="border border-gray-300 px-4 py-2">₹30/KG</td>
                    <td class="border border-gray-300 px-4 py-2">Customs clearance, insurance options</td> <!-- Example data -->
                </tr>
                <tr>
                    <td class="border border-gray-300 px-4 py-2">Road Transport</td>
                    <td class="border border-gray-300 px-4 py-2">Reliable and efficient ground logistics solutions.</td>
                    <td class="border border-gray-300 px-4 py-2">₹20/KG</td>
                    <td class="border border-gray-300 px-4 py-2">Door-to-door delivery, flexible scheduling</td> <!-- Example data -->
                </tr>
            </tbody>
        </table>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 px-4 bg-blue-600 dark:bg-blue-700">
    <div class="max-w-7xl mx-auto text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Ready to Optimize Your Logistics?</h2>
        <p class="text-lg text-blue-100 mb-8">Contact us today to discuss how we can help streamline your supply chain.</p>
        <a href="contact.php" class="inline-block bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition-colors duration-200">Get Started</a>
    </div>
</section>

<script>
    // Initialize GSAP ScrollTrigger
    gsap.registerPlugin(ScrollTrigger);

    // Animate service cards on scroll
    const serviceCards = document.querySelectorAll('.service-card');
    serviceCards.forEach((card, index) => {
        gsap.from(card, {
            opacity: 0,
            y: 50,
            duration: 0.8,
            delay: index * 0.2,
            scrollTrigger: {
                trigger: card,
                start: 'top bottom-=100',
                toggleActions: 'play none none reverse'
            }
        });
    });
</script>

<?php include 'footer.php'; ?>