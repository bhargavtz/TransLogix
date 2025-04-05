<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - TransLogix</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-white dark:bg-gray-900 transition-colors duration-200">
<?php include 'navbar.php'; ?>

    <!-- Contact Hero Section -->
    <section class="pt-24 pb-12 md:pt-32 md:pb-20 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-800 dark:to-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold text-gray-900 dark:text-white mb-6">Get in Touch</h1>
                <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 max-w-3xl mx-auto">Have questions about our services? We're here to help. Contact us today for personalized logistics solutions.</p>
            </div>
        </div>
    </section>

    <!-- Contact Information Cards -->
    <section class="py-16 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                <!-- Phone -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 text-center">
                    <div class="w-16 h-16 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-phone text-2xl text-blue-600 dark:text-blue-400"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Phone</h3>
                    <p class="text-gray-600 dark:text-gray-300">+1 (555) 123-4567</p>
                    <p class="text-gray-600 dark:text-gray-300">Mon-Fri, 9am-6pm</p>
                </div>

                <!-- Email -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 text-center">
                    <div class="w-16 h-16 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-envelope text-2xl text-blue-600 dark:text-blue-400"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Email</h3>
                    <p class="text-gray-600 dark:text-gray-300">info@translogix.com</p>
                    <p class="text-gray-600 dark:text-gray-300">support@translogix.com</p>
                </div>

                <!-- Address -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 text-center">
                    <div class="w-16 h-16 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-location-dot text-2xl text-blue-600 dark:text-blue-400"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Address</h3>
                    <p class="text-gray-600 dark:text-gray-300">123 Logistics Way</p>
                    <p class="text-gray-600 dark:text-gray-300">London, UK EC1A 1BB</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Contact Form -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Send Us a Message</h2>
                    <form id="contactForm" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Name</label>
                                <input type="text" id="name" name="name" required
                                    class="w-full px-4 py-2 rounded-lg border-2 border-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-400 bg-white dark:bg-gray-800 text-gray-900 dark:text-white">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label>
                                <input type="email" id="email" name="email" required
                                    class="w-full px-4 py-2 rounded-lg border-2 border-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-400 bg-white dark:bg-gray-800 text-gray-900 dark:text-white">
                            </div>
                        </div>
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Subject</label>
                            <input type="text" id="subject" name="subject" required
                                class="w-full px-4 py-2 rounded-lg border-2 border-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-400 bg-white dark:bg-gray-800 text-gray-900 dark:text-white">
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Message</label>
                            <textarea id="message" name="message" rows="4" required
                                class="w-full px-4 py-2 rounded-lg border-2 border-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-400 bg-white dark:bg-gray-800 text-gray-900 dark:text-white"></textarea>
                        </div>
                        <button type="submit"
                            class="w-full px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">
                            Send Message
                        </button>
                    </form>
                </div>

                <!-- Map -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2483.2889612073466!2d-0.09717892384796901!3d51.51714017169675!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48761b553d1b2271%3A0xa32af51515e0d787!2sCity%20of%20London%2C%20London%2C%20UK!5e0!3m2!1sen!2sus!4v1709663436895!5m2!1sen!2sus"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer (Same as other pages) -->
    <footer class="bg-gray-100 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">TransLogix</h3>
                    <p class="text-gray-600 dark:text-gray-300">Your trusted logistics partner worldwide</p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="/TransLogix/about.php" class="text-gray-600 dark:text-gray-300 hover:text-blue-600">About Us</a></li>
                        <li><a href="/TransLogix/services.php" class="text-gray-600 dark:text-gray-300 hover:text-blue-600">Services</a></li>
                        <li><a href="/TransLogix/tracking.php" class="text-gray-600 dark:text-gray-300 hover:text-blue-600">Track Shipment</a></li>
                        <li><a href="/TransLogix/contact.php" class="text-gray-600 dark:text-gray-300 hover:text-blue-600">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Services</h4>
                    <ul class="space-y-2">
                        <li><a href="/TransLogix/services.php" class="text-gray-600 dark:text-gray-300 hover:text-blue-600">Air Freight</a></li>
                        <li><a href="/TransLogix/services.php" class="text-gray-600 dark:text-gray-300 hover:text-blue-600">Sea Freight</a></li>
                        <li><a href="/TransLogix/services.php" class="text-gray-600 dark:text-gray-300 hover:text-blue-600">Road Transport</a></li>
                        <li><a href="/TransLogix/services.php" class="text-gray-600 dark:text-gray-300 hover:text-blue-600">Warehousing</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Connect With Us</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-600 dark:text-gray-300 hover:text-blue-600"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-gray-600 dark:text-gray-300 hover:text-blue-600"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-600 dark:text-gray-300 hover:text-blue-600"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="text-gray-600 dark:text-gray-300 hover:text-blue-600"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-gray-200 dark:border-gray-700">
                <p class="text-center text-gray-600 dark:text-gray-300">&copy; 2024 TransLogix. All rights reserved.</p>
            </div>
        </div>
    </footer>

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

        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');

        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Contact form handling
        const contactForm = document.getElementById('contactForm');
        contactForm.addEventListener('submit', (e) => {
            e.preventDefault();
            // Here you would typically send the form data to a server
            alert('Thank you for your message. We will get back to you soon!');
            contactForm.reset();
        });

        // Animations
        gsap.from('.hero h1', {
            opacity: 0,
            y: 30,
            duration: 1,
            ease: "power3.out"
        });

        gsap.from('.hero p', {
            opacity: 0,
            y: 20,
            duration: 1,
            delay: 0.2,
            ease: "power3.out"
        });

        gsap.from('.bg-white.dark\\:bg-gray-800', {
            opacity: 0,
            y: 30,
            duration: 0.8,
            stagger: 0.2,
            ease: "power3.out",
            scrollTrigger: {
                trigger: '.bg-white.dark\\:bg-gray-800',
                start: "top 80%"
            }
        });
    </script>
</body>
</html>