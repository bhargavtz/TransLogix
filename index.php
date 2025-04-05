<?php
session_start();
$isLoggedIn = isset($_SESSION['user']); // Check if the user is logged in
$user = $isLoggedIn ? $_SESSION['user'] : null; // Get user data if logged in
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TransLogix - Advanced Transportation Logistics</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Color Palette */
        :root {
            --ice-blue: #D6E6F2;
            --powder-blue: #A6C6D8;
            --sapphire: #0F52BA;
            --deep-navy: #000A26;
        }

        /* General Styles */
        body {
            font-family: 'Roboto', sans-serif; /* Updated font family for body content */
            background-color: var(--ice-blue);
            color: var(--deep-navy);
        }

        h1, h2, h3 {
            font-family: 'Poppins', sans-serif; /* Updated font family for headings */
            font-weight: bold;
        }

        a {
            text-decoration: none;
        }

        /* Hero Section */
        .hero-section {
            position: relative;
            background: linear-gradient(135deg, var(--sapphire), var(--powder-blue));
            color: white;
            padding: 6rem 2rem;
            text-align: center;
            overflow: hidden;
        }

        .hero-section h1 {
            font-size: 3.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .hero-section p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
        }

        .hero-section a {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            margin: 0.5rem;
            border-radius: 0.5rem;
            font-weight: bold;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .btn-primary {
            background-color: var(--deep-navy);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--sapphire);
        }

        .btn-secondary {
            background-color: white;
            color: var(--deep-navy);
            border: 2px solid var(--deep-navy);
        }

        .btn-secondary:hover {
            background-color: var(--powder-blue);
        }

        /* Section Titles */
        .section-title h2 {
            font-size: 2.5rem;
            color: var(--sapphire);
        }

        .section-title p {
            font-size: 1.125rem;
            color: var (--deep-navy);
        }

        /* Cards */
        .card {
            background-color: white;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.15);
        }

        .card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: var(--sapphire);
        }

        .card p {
            color: var(--deep-navy);
        }

        /* Floating Icons */
        .floating-icon {
            position: absolute;
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .floating-icon:nth-child(1) {
            top: 10%;
            left: 20%;
            animation-delay: 0s;
        }

        .floating-icon:nth-child(2) {
            top: 30%;
            right: 15%;
            animation-delay: 2s;
        }

        .floating-icon:nth-child(3) {
            bottom: 20%;
            left: 10%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-20px);
            }
        }
    </style>
</head>
<body class="bg-white dark:bg-gray-900 transition-colors duration-200">
    <?php include 'navbar.php'; ?>
    <div class="scroll-progress"></div>
    <section class="hero-section">
        <div class="floating-icon"></div>
        <div class="floating-icon"></div>
        <div class="floating-icon"></div>
        <h1>Our Services</h1>
        <p>Your trusted partner in worldwide transportation and logistics services.</p>
        <a href="http://localhost/TransLogix/tracking.php" class="btn-primary">Track Shipment</a>
        <a href="http://localhost/TransLogix/contact.php" class="btn-secondary">Get a Quote</a>
    </section>

    <!-- Our Services Section -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white fade-in">Our Services</h2>
                <p class="text-xl text-gray-600 dark:text-gray-300 mt-4 fade-in">Efficient logistics solutions tailored for you.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="card slide-in-left transform transition-all duration-300 hover:scale-105 hover:shadow-xl">
                    <img src="https://ladingcargo.com/blog/wp-content/uploads/2023/09/key-advantages-of-ground-transportation.png" alt="Ground Transportation" class="w-full h-48 object-cover rounded-t-lg transition-transform duration-300 hover:opacity-90">
                    <div class="p-4">
                        <h3>Ground Transportation</h3>
                        <p>We provide reliable and efficient ground logistics solutions, ensuring timely deliveries and cost-effective services for your business needs.</p>
                    </div>
                </div>
                <div class="card fade-in transform transition-all duration-300 hover:scale-105 hover:shadow-xl">
                    <img src="https://www.savinodelbene.com/wp-content/uploads/2023/10/ocean-freight-shipping.png" alt="Ocean Freight" class="w-full h-48 object-cover rounded-t-lg transition-transform duration-300 hover:opacity-90">
                    <div class="p-4">
                        <h3>Ocean Freight</h3>
                        <p>Our comprehensive ocean freight services cater to global shipping requirements, offering secure and efficient transportation across the seas.</p>
                    </div>
                </div>
                <div class="card slide-in-right transform transition-all duration-300 hover:scale-105 hover:shadow-xl">
                    <img src="https://media.istockphoto.com/id/504606896/photo/stack-of-cargo-containers-at-the-docks.jpg?s=612x612&w=0&k=20&c=JinxScutWXDYJX10eRw6OOolv8ddCgNZZwbvHibi3Uo=" alt="Air Freight" class="w-full h-48 object-cover rounded-t-lg transition-transform duration-300 hover:opacity-90">
                    <div class="p-4">
                        <h3>Air Freight</h3>
                        <p>Fast and secure air freight services for time-sensitive shipments, ensuring your goods reach their destination on time, every time.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- New Content Section -->
    <section class="py-16 bg-gray-50 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white fade-in">Why Choose TransLogix?</h2>
                <p class="text-xl text-gray-600 dark:text-gray-300 mt-4 fade-in">Discover the benefits of partnering with us for your logistics needs.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="p-6 bg-white dark:bg-gray-700 rounded-lg shadow-md slide-in-left">
                    <i class="fas fa-globe text-4xl text-blue-600 dark:text-blue-400 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Global Reach</h3>
                    <p class="text-gray-600 dark:text-gray-300 mt-2">With a presence in over 50 countries, we ensure seamless logistics solutions worldwide.</p>
                </div>
                <div class="p-6 bg-white dark:bg-gray-700 rounded-lg shadow-md fade-in">
                    <i class="fas fa-clock text-4xl text-blue-600 dark:text-blue-400 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Timely Deliveries</h3>
                    <p class="text-gray-600 dark:text-gray-300 mt-2">Our commitment to on-time delivery ensures your business runs smoothly.</p>
                </div>
                <div class="p-6 bg-white dark:bg-gray-700 rounded-lg shadow-md slide-in-right">
                    <i class="fas fa-shield-alt text-4xl text-blue-600 dark:text-blue-400 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Secure Handling</h3>
                    <p class="text-gray-600 dark:text-gray-300 mt-2">We prioritize the safety and security of your shipments at every step.</p>
                </div>
                <div class="p-6 bg-white dark:bg-gray-700 rounded-lg shadow-md slide-in-left">
                    <i class="fas fa-handshake text-4xl text-blue-600 dark:text-blue-400 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Customer-Centric Approach</h3>
                    <p class="text-gray-600 dark:text-gray-300 mt-2">We focus on building long-term relationships by understanding and fulfilling your unique needs.</p>
                </div>
                <div class="p-6 bg-white dark:bg-gray-700 rounded-lg shadow-md fade-in">
                    <i class="fas fa-chart-line text-4xl text-blue-600 dark:text-blue-400 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Cost Efficiency</h3>
                    <p class="text-gray-600 dark:text-gray-300 mt-2">Our optimized logistics solutions help you save costs while maintaining high service quality.</p>
                </div>
                <div class="p-6 bg-white dark:bg-gray-700 rounded-lg shadow-md slide-in-right">
                    <i class="fas fa-leaf text-4xl text-blue-600 dark:text-blue-400 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Sustainability</h3>
                    <p class="text-gray-600 dark:text-gray-300 mt-2">We are committed to eco-friendly practices, ensuring a greener future for logistics.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Achievements Section -->
    <section class="py-16 bg-gray-50 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">Our Achievements</h2>
                <p class="text-xl text-gray-600 dark:text-gray-300 mt-4">Celebrating milestones and accomplishments that define our success.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center achievement-item">
                    <i class="fas fa-globe text-6xl text-blue-600 dark:text-blue-400 mb-4"></i>
                    <h3 class="text-4xl font-bold text-gray-900 dark:text-white counter" data-target="50">0</h3>
                    <p class="text-gray-600 dark:text-gray-300 mt-2">Countries Covered</p>
                </div>
                <div class="text-center achievement-item">
                    <i class="fas fa-truck text-6xl text-blue-600 dark:text-blue-400 mb-4"></i>
                    <h3 class="text-4xl font-bold text-gray-900 dark:text-white counter" data-target="1000">0</h3>
                    <p class="text-gray-600 dark:text-gray-300 mt-2">Shipments Delivered</p>
                </div>
                <div class="text-center achievement-item">
                    <i class="fas fa-users text-6xl text-blue-600 dark:text-blue-400 mb-4"></i>
                    <h3 class="text-4xl font-bold text-gray-900 dark:text-white counter" data-target="500">0</h3>
                    <p class="text-gray-600 dark:text-gray-300 mt-2">Happy Clients</p>
                </div>
                <div class="text-center achievement-item">
                    <i class="fas fa-award text-6xl text-blue-600 dark:text-blue-400 mb-4"></i>
                    <h3 class="text-4xl font-bold text-gray-900 dark:text-white counter" data-target="20">0</h3>
                    <p class="text-gray-600 dark:text-gray-300 mt-2">Awards Won</p>
                </div>
            </div>
        </div>
    </section>

    <!-- New Animated Section: Our Vision -->
    <section class="py-16 bg-gradient-to-r from-blue-600 to-blue-400 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold">Our Vision</h2>
                <p class="text-xl mt-4">Driving innovation and excellence in global logistics.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-6 bg-white text-blue-600 rounded-lg shadow-lg vision-item">
                    <i class="fas fa-lightbulb text-5xl mb-4"></i>
                    <h3 class="text-2xl font-semibold">Innovation</h3>
                    <p class="mt-2">We embrace cutting-edge technology to deliver exceptional logistics solutions.</p>
                </div>
                <div class="p-6 bg-white text-blue-600 rounded-lg shadow-lg vision-item">
                    <i class="fas fa-handshake text-5xl mb-4"></i>
                    <h3 class="text-2xl font-semibold">Collaboration</h3>
                    <p class="mt-2">Partnering with clients to achieve shared success and long-term growth.</p>
                </div>
                <div class="p-6 bg-white text-blue-600 rounded-lg shadow-lg vision-item">
                    <i class="fas fa-globe-americas text-5xl mb-4"></i>
                    <h3 class="text-2xl font-semibold">Sustainability</h3>
                    <p class="mt-2">Committed to eco-friendly practices for a better future.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-16 bg-gray-50 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">What Our Clients Say</h2>
                <p class="text-xl text-gray-600 dark:text-gray-300 mt-4">Hear from our satisfied customers.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="p-6 bg-white dark:bg-gray-700 rounded-lg shadow-md">
                    <p class="text-gray-600 dark:text-gray-300 italic">"TransLogix has been a game-changer for our logistics needs. Their service is top-notch!"</p>
                    <h4 class="mt-4 text-lg font-semibold text-gray-900 dark:text-white">- John Doe, CEO of ABC Corp</h4>
                </div>
                <div class="p-6 bg-white dark:bg-gray-700 rounded-lg shadow-md">
                    <p class="text-gray-600 dark:text-gray-300 italic">"Reliable, efficient, and professional. Highly recommended!"</p>
                    <h4 class="mt-4 text-lg font-semibold text-gray-900 dark:text-white">- Jane Smith, Logistics Manager</h4>
                </div>
                <div class="p-6 bg-white dark:bg-gray-700 rounded-lg shadow-md">
                    <p class="text-gray-600 dark:text-gray-300 italic">"Their global reach and timely deliveries have been invaluable to our business."</p>
                    <h4 class="mt-4 text-lg font-semibold text-gray-900 dark:text-white">- Michael Brown, Operations Head</h4>
                </div>
            </div>
        </div>
    </section>


    <section class="py-16 bg-blue-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white">Ready to Transform Your Logistics?</h2>
            <p class="text-xl text-blue-100 mt-4">Partner with TransLogix for reliable and efficient logistics solutions.</p>
            <a href="/TransLogix/contact.php" class="mt-6 inline-block px-6 py-3 bg-white text-blue-600 font-semibold rounded-lg hover:bg-blue-100">Get Started</a>
        </div>
    </section>


    <script>
        // Enhanced counter animation function with easing
        function animateCounter(element, target) {
            let current = 0;
            const duration = 2000; // 2 seconds
            const step = Math.ceil(target / (duration / 16)); 
            function update() {
                current = Math.min(current + step, target);
                element.textContent = current;
                
                if (current < target) {
                    requestAnimationFrame(update);
                }
            }
            
            update();
        }

        // Initialize counters with enhanced intersection observer
        const counterElements = document.querySelectorAll('.counter');
        const observerOptions = {
            threshold: 0.2,
            rootMargin: '50px'
        };

        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const target = parseInt(entry.target.getAttribute('data-target'));
                    if (!isNaN(target)) {
                        animateCounter(entry.target, target);
                        counterObserver.unobserve(entry.target);
                    }
                }
            });
        }, observerOptions);

        // Add smooth scroll behavior
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        counterElements.forEach(counter => {
            counterObserver.observe(counter);
        });

        // Enhanced dark mode toggle with system preference detection and smooth transitions
        const darkModeToggle = document.getElementById('darkModeToggle');
        const html = document.documentElement;
        const moonIcon = darkModeToggle.querySelector('.fa-moon');
        const sunIcon = darkModeToggle.querySelector('.fa-sun');

        function updateTheme(isDark, withTransition = true) {
            if (withTransition) {
                html.classList.add('transition-colors');
            }

            // Update theme
            html.classList.toggle('dark', isDark);
            
            // Smooth icon transition with proper state management
            moonIcon.style.transition = 'opacity 0.3s ease';
            sunIcon.style.transition = 'opacity 0.3s ease';
            
            if (isDark) {
                moonIcon.style.opacity = '0';
                sunIcon.style.opacity = '1';
                setTimeout(() => {
                    moonIcon.style.display = 'none';
                    sunIcon.style.display = 'block';
                }, 300);
            } else {
                sunIcon.style.opacity = '0';
                moonIcon.style.opacity = '1';
                setTimeout(() => {
                    sunIcon.style.display = 'none';
                    moonIcon.style.display = 'block';
                }, 300);
            }
            
            // Store preference
            localStorage.setItem('darkMode', isDark);
            
            if (withTransition) {
                setTimeout(() => {
                    html.classList.remove('transition-colors');
                }, 300);
            }
        }

        // Check system preference
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)');
        
        // Initialize theme based on stored preference or system preference
        const storedTheme = localStorage.getItem('darkMode');
        if (storedTheme !== null) {
            updateTheme(storedTheme === 'true', false);
        } else {
            updateTheme(prefersDark.matches, false);
        }

        // Listen for system theme changes
        prefersDark.addEventListener('change', (e) => {
            if (localStorage.getItem('darkMode') === null) {
                updateTheme(e.matches);
            }
        });

        darkModeToggle.addEventListener('click', () => {
            const isDark = !html.classList.contains('dark');
            updateTheme(isDark);
        });

        // Check for saved dark mode preference
        if (localStorage.getItem('darkMode') === 'true') {
            updateTheme(true);
        } else {
            updateTheme(false);
        }

        // Enhanced mobile menu toggle with smooth transitions and proper state management
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        let isMobileMenuOpen = false;

        // Initialize mobile menu styles
        mobileMenu.style.transition = 'all 0.3s ease-in-out';
        mobileMenu.style.opacity = '0';
        mobileMenu.style.transform = 'translateY(-10px)';
        mobileMenu.style.display = 'none';

        // Mobile menu toggle function with animation
        function toggleMobileMenu() {
            isMobileMenuOpen = !isMobileMenuOpen;
            
            if (isMobileMenuOpen) {
                mobileMenu.style.display = 'block';
                // Use requestAnimationFrame to ensure display change is processed
                requestAnimationFrame(() => {
                    mobileMenu.style.opacity = '1';
                    mobileMenu.style.transform = 'translateY(0)';
                });
            } else {
                mobileMenu.style.opacity = '0';
                mobileMenu.style.transform = 'translateY(-10px)';
                // Wait for transition to complete before hiding
                setTimeout(() => {
                    mobileMenu.style.display = 'none';
                }, 300);
            }

            // Update button icon
            const icon = mobileMenuBtn.querySelector('i');
            icon.classList.toggle('fa-bars');
            icon.classList.toggle('fa-times');
        }

        // Add click event listener
        mobileMenuBtn.addEventListener('click', toggleMobileMenu);

        // Close mobile menu on window resize if open
        window.addEventListener('resize', () => {
            if (isMobileMenuOpen && window.innerWidth >= 768) {
                toggleMobileMenu();
            }
        });
        mobileMenu.style.transform = 'translateY(-10px)';
        mobileMenu.style.opacity = '0';

        mobileMenuBtn.addEventListener('click', () => {
            if (mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.remove('hidden');
                requestAnimationFrame(() => {
                    mobileMenu.style.transform = 'translateY(0)';
                    mobileMenu.style.opacity = '1';
                });
            } else {
                mobileMenu.style.transform = 'translateY(-10px)';
                mobileMenu.style.opacity = '0';
                setTimeout(() => {
                    mobileMenu.classList.add('hidden');
                }, 300);
            }
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!mobileMenu.contains(e.target) && !mobileMenuBtn.contains(e.target) && !mobileMenu.classList.contains('hidden')) {
                mobileMenuBtn.click();
            }
        });

        // Register ScrollTrigger
        gsap.registerPlugin(ScrollTrigger);

        // GSAP Animations
        gsap.from('.hero h1', {
            duration: 1,
            y: 50,
            opacity: 0,
            ease: 'power3.out'
        });

        gsap.from('.hero p', {
            duration: 1,
            y: 30,
            opacity: 0,
            delay: 0.3,
            ease: 'power3.out'
        });

        gsap.from('.hero a', {
            duration: 0.8,
            y: 20,
            opacity: 0,
            delay: 0.6,
            stagger: 0.2,
            ease: 'power3.out'
        });

        // Animate feature cards on scroll
        gsap.from('.feature-card', {
            scrollTrigger: {
                trigger: '.feature-card',
                start: 'top 80%',
                toggleActions: 'play none none reverse'
            },
            duration: 0.8,
            y: 50,
            opacity: 0,
            stagger: 0.2,
            ease: 'power3.out'
        });

        // Enhanced parallax effect for hero section
        gsap.to('.parallax-bg', {
            scrollTrigger: {
                trigger: '.parallax-bg',
                start: 'top top',
                end: 'bottom top',
                scrub: 1
            },
            y: 200,
            scale: 1.1,
            ease: 'none'
        });

        // Statistics counter animation
        const stats = document.querySelectorAll('.stat-number');
        stats.forEach(stat => {
            const target = parseInt(stat.getAttribute('data-target'));
            let current = 0;
            const increment = target / 50;
            const updateCount = () => {
                if (current < target) {
                    current += increment;
                    stat.textContent = Math.ceil(current).toLocaleString();
                    requestAnimationFrame(updateCount);
                } else {
                    stat.textContent = target.toLocaleString();
                }
            };
            ScrollTrigger.create({
                trigger: stat,
                start: 'top 80%',
                onEnter: () => updateCount()
            });
        });
        
        // Scroll progress indicator
        const scrollProgress = document.querySelector('.scroll-progress');
        window.addEventListener('scroll', () => {
            const totalHeight = document.body.scrollHeight - window.innerHeight;
            const progress = (window.pageYOffset / totalHeight) * 100;
            scrollProgress.style.width = `${progress}%`;
        });
        
        // Reveal on scroll animation
        const revealElements = document.querySelectorAll('.reveal-on-scroll');
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const delay = entry.target.getAttribute('data-delay') || 0;
                    setTimeout(() => {
                        entry.target.classList.add('active');
                    }, delay * 1000);
                    revealObserver.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });
        
        revealElements.forEach(element => {
            revealObserver.observe(element);
        });
        
        // Staggered animation for list items
        const staggerContainers = document.querySelectorAll('.stagger-container');
        staggerContainers.forEach(container => {
            const staggerItems = container.querySelectorAll('.stagger-item');
            const staggerObserver = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting) {
                    staggerItems.forEach((item, index) => {
                        setTimeout(() => {
                            item.classList.add('active');
                        }, 100 * index);
                    });
                    staggerObserver.unobserve(container);
                }
            }, {
                threshold: 0.1
            });
            
            staggerObserver.observe(container);
        });
        
        // Initialize all elements with reveal-on-scroll class
        document.addEventListener('DOMContentLoaded', () => {
            const revealItems = document.querySelectorAll('.reveal-on-scroll');
            revealItems.forEach(item => {
                item.style.opacity = '0';
                item.style.transform = 'translateY(30px)';
            });
            
            // Trigger initial animations for elements in viewport
            setTimeout(() => {
                revealItems.forEach(item => {
                    revealObserver.observe(item);
                });
            }, 100);
        });

        // GSAP Animations
        gsap.registerPlugin(ScrollTrigger);

        // Fade-in animations
        gsap.utils.toArray('.fade-in').forEach((element) => {
            gsap.fromTo(element, { opacity: 0, y: 20 }, {
                opacity: 1,
                y: 0,
                duration: 0.8,
                scrollTrigger: {
                    trigger: element,
                    start: 'top 80%',
                    toggleActions: 'play none none reverse'
                }
            });
        });

        // Slide-in animations
        gsap.utils.toArray('.slide-in-left').forEach((element) => {
            gsap.fromTo(element, { opacity: 0, x: -30 }, {
                opacity: 1,
                x: 0,
                duration: 0.8,
                scrollTrigger: {
                    trigger: element,
                    start: 'top 80%',
                    toggleActions: 'play none none reverse'
                }
            });
        });

        gsap.utils.toArray('.slide-in-right').forEach((element) => {
            gsap.fromTo(element, { opacity: 0, x: 30 }, {
                opacity: 1,
                x: 0,
                duration: 0.8,
                scrollTrigger: {
                    trigger: element,
                    start: 'top 80%',
                    toggleActions: 'play none none reverse'
                }
            });
        });

        // Parallax effect for hero section
        gsap.to('.parallax-bg', {
            y: 100,
            ease: 'none',
            scrollTrigger: {
                trigger: '.parallax-bg',
                start: 'top top',
                end: 'bottom top',
                scrub: true
            }
        });

        // Theme toggle functionality
        const themeToggle = document.getElementById('themeToggle');
        const themeToggleMobile = document.getElementById('themeToggleMobile');
        const html = document.documentElement;

        function toggleTheme() {
            const isDark = html.classList.contains('dark');
            html.classList.toggle('dark', !isDark);
            localStorage.setItem('theme', !isDark ? 'dark' : 'light');
        }

        // Initialize theme based on saved preference or system preference
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme) {
            html.classList.toggle('dark', savedTheme === 'dark');
        } else {
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            html.classList.toggle('dark', prefersDark);
        }

        // Attach event listeners to toggle buttons
        themeToggle.addEventListener('click', toggleTheme);
        themeToggleMobile.addEventListener('click', toggleTheme);

        // GSAP Animations for Our Achievements Section
        gsap.utils.toArray('.achievement-item').forEach((item, index) => {
            gsap.fromTo(item, { opacity: 0, y: 50 }, {
                opacity: 1,
                y: 0,
                duration: 1,
                delay: index * 0.2,
                scrollTrigger: {
                    trigger: item,
                    start: 'top 80%',
                    toggleActions: 'play none none reverse'
                }
            });
        });

        // GSAP Animations for Our Vision Section
        gsap.utils.toArray('.vision-item').forEach((item, index) => {
            gsap.fromTo(item, { opacity: 0, scale: 0.8 }, {
                opacity: 1,
                scale: 1,
                duration: 1,
                delay: index * 0.3,
                scrollTrigger: {
                    trigger: item,
                    start: 'top 80%',
                    toggleActions: 'play none none reverse'
                }
            });
        });

        // Counter Animation for Our Achievements Section
        document.querySelectorAll('.counter').forEach(counter => {
            const target = +counter.getAttribute('data-target');
            let count = 0;
            const increment = target / 100;

            const updateCounter = () => {
                count += increment;
                if (count < target) {
                    counter.textContent = Math.ceil(count);
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.textContent = target;
                }
            };

            ScrollTrigger.create({
                trigger: counter,
                start: 'top 80%',
                onEnter: updateCounter
            });
        });

        // GSAP Animations for Hero Section
        gsap.fromTo(".hero-section h1", { opacity: 0, y: 50 }, {
            opacity: 1,
            y: 0,
            duration: 1,
            ease: "power3.out"
        });

        gsap.fromTo(".hero-section p", { opacity: 0, y: 50 }, {
            opacity: 1,
            y: 0,
            duration: 1,
            delay: 0.3,
            ease: "power3.out"
        });

        gsap.fromTo(".hero-section a", { opacity: 0, y: 50 }, {
            opacity: 1,
            y: 0,
            duration: 0.8,
            delay: 0.6,
            stagger: 0.2,
            ease: "power3.out"
        });

        // Floating Icons Animation
        gsap.to(".floating-icon", {
            y: 20,
            repeat: -1,
            yoyo: true,
            duration: 3,
            ease: "sine.inOut"
        });

        // GSAP Animations for "Our Services" Section
        gsap.registerPlugin(ScrollTrigger);

        // Fade-in animations
        gsap.utils.toArray('.fade-in').forEach((element) => {
            gsap.fromTo(element, { opacity: 0, y: 20 }, {
                opacity: 1,
                y: 0,
                duration: 0.8,
                scrollTrigger: {
                    trigger: element,
                    start: 'top 80%',
                    toggleActions: 'play none none reverse'
                }
            });
        });

        // Slide-in animations
        gsap.utils.toArray('.slide-in-left').forEach((element) => {
            gsap.fromTo(element, { opacity: 0, x: -30 }, {
                opacity: 1,
                x: 0,
                duration: 0.8,
                scrollTrigger: {
                    trigger: element,
                    start: 'top 80%',
                    toggleActions: 'play none none reverse'
                }
            });
        });

        gsap.utils.toArray('.slide-in-right').forEach((element) => {
            gsap.fromTo(element, { opacity: 0, x: 30 }, {
                opacity: 1,
                x: 0,
                duration: 0.8,
                scrollTrigger: {
                    trigger: element,
                    start: 'top 80%',
                    toggleActions: 'play none none reverse'
                }
            });
        });

        // GSAP Animations for "Why Choose TransLogix?" Section
        gsap.registerPlugin(ScrollTrigger);

        // Fade-in animations
        gsap.utils.toArray('.fade-in').forEach((element) => {
            gsap.fromTo(element, { opacity: 0, y: 20 }, {
                opacity: 1,
                y: 0,
                duration: 0.8,
                scrollTrigger: {
                    trigger: element,
                    start: 'top 80%',
                    toggleActions: 'play none none reverse'
                }
            });
        });

        // Slide-in animations
        gsap.utils.toArray('.slide-in-left').forEach((element) => {
            gsap.fromTo(element, { opacity: 0, x: -30 }, {
                opacity: 1,
                x: 0,
                duration: 0.8,
                scrollTrigger: {
                    trigger: element,
                    start: 'top 80%',
                    toggleActions: 'play none none reverse'
                }
            });
        });

        gsap.utils.toArray('.slide-in-right').forEach((element) => {
            gsap.fromTo(element, { opacity: 0, x: 30 }, {
                opacity: 1,
                x: 0,
                duration: 0.8,
                scrollTrigger: {
                    trigger: element,
                    start: 'top 80%',
                    toggleActions: 'play none none reverse'
                }
            });
        });

        // Counter animation for "Our Achievements" section
        const counters = document.querySelectorAll('.counter');
        const speed = 200; // Adjust speed for counter animation

        counters.forEach(counter => {
            const updateCount = () => {
                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText;
                const increment = target / speed;

                if (count < target) {
                    counter.innerText = Math.ceil(count + increment);
                    setTimeout(updateCount, 10);
                } else {
                    counter.innerText = target;
                }
            };

            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        updateCount();
                        observer.unobserve(counter);
                    }
                });
            });

            observer.observe(counter);
        });
    </script>
<?php include 'footer.php'; ?>
</body>
</html>