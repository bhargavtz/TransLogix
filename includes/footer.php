<?php
// Add any PHP logic here that needs to run before the footer
?>
    <!-- Footer -->
    <footer class="bg-gray-100 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">About Us</h3>
                    <p class="text-gray-600 dark:text-gray-300">TransLogix is your trusted partner in logistics and transportation solutions, delivering excellence across the globe.</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="/TransLogix/about.php" class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">About</a></li>
                        <li><a href="/TransLogix/services.php" class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">Services</a></li>
                        <li><a href="/TransLogix/tracking.php" class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">Tracking</a></li>
                        <li><a href="/TransLogix/contact.php" class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Legal</h3>
                    <ul class="space-y-2">
                        <li><a href="/TransLogix/terms.php" class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">Terms & Conditions</a></li>
                        <li><a href="/TransLogix/privacy.php" class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">Privacy Policy</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Connect With Us</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-200 dark:border-gray-700 mt-8 pt-8 text-center">
                <p class="text-gray-600 dark:text-gray-300">&copy; <?php echo date('Y'); ?> TransLogix. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Dark mode toggle script -->
    <script>
        const darkModeToggle = document.getElementById('darkModeToggle');
        const html = document.documentElement;

        // Check for saved dark mode preference
        if (localStorage.getItem('darkMode') === 'true' || 
            (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            html.classList.add('dark');
        }

        // Toggle dark mode
        darkModeToggle.addEventListener('click', () => {
            html.classList.toggle('dark');
            localStorage.setItem('darkMode', html.classList.contains('dark'));
        });
    </script>
</body>
</html>