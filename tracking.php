<?php
include 'header.php';
include 'TransLogix/navbar.php'; // Corrected the path to the navigation file
?>

<!-- Tracking Hero Section -->
<section class="pt-24 pb-12 md:pt-32 md:pb-20 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-800 dark:to-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold text-gray-900 dark:text-white mb-6">Track Your Shipment</h1>
            <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 max-w-3xl mx-auto">Enter your tracking number to get real-time updates on the status and location of your shipment.</p>

            <div class="max-w-2xl mx-auto">
                <form id="trackingForm" class="flex flex-col md:flex-row gap-4">
                    <div class="relative flex-1">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" id="trackingNumber" placeholder="Enter tracking number (e.g. TL1001)" 
                               class="w-full pl-10 pr-4 py-3 rounded-lg border-2 border-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-400 bg-white dark:bg-gray-800 text-gray-900 dark:text-white">
                    </div>
                    <button type="submit" id="searchButton" class="px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Track
                    </button>
                </form>
                <div class="mt-4 text-sm text-gray-500 dark:text-gray-400">
                    Try with sample tracking IDs: TL1001, TL1002, TL1003, TL1004
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Tracking Results Section -->
<section id="trackingResults" class="py-16 bg-white dark:bg-gray-900 hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Shipment Status and Map -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Shipment Status -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Shipment Status</h2>
                    <span id="statusBadge" class="px-4 py-2 rounded-full text-white"></span>
                </div>
                <div class="space-y-4">
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-2">Tracking Number</h3>
                        <p id="displayTrackingNumber" class="text-lg font-medium text-gray-900 dark:text-white"></p>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-2">Customer Name</h3>
                        <p id="customerName" class="text-lg font-medium text-gray-900 dark:text-white"></p>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-2">Contact</h3>
                        <p id="customerContact" class="text-lg font-medium text-gray-900 dark:text-white"></p>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-2">Current Location</h3>
                        <p id="currentLocation" class="text-lg font-medium text-gray-900 dark:text-white"></p>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-2">Destination</h3>
                        <p id="destination" class="text-lg font-medium text-gray-900 dark:text-white"></p>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-2">Estimated Delivery</h3>
                        <p id="estimatedDelivery" class="text-lg font-medium text-gray-900 dark:text-white"></p>
                    </div>
                </div>
            </div>
            <!-- Google Map -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                <div id="map" class="w-full h-[500px]"></div>
            </div>
        </div>

        <!-- Tracking Timeline -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Tracking Timeline</h2>
            <div id="trackingTimeline" class="space-y-8 relative pb-2">
                <!-- Timeline items will be dynamically inserted here -->
            </div>
        </div>
        
        <style>
            /* Timeline styling */
            #trackingTimeline .timeline-line {
                position: absolute;
                left: 3px;
                top: 6px;
                bottom: 6px;
                width: 2px;
                background: linear-gradient(to bottom, #4285F4, #34A853);
                z-index: 0;
            }
            
            /* Timeline item hover effect */
            #trackingTimeline > div:hover {
                transform: translateX(4px) !important;
            }
            
            /* Timeline dot pulse animation */
            @keyframes pulse {
                0% { transform: scale(1); }
                50% { transform: scale(1.2); }
                100% { transform: scale(1); }
            }
            
            #trackingTimeline > div:first-child .flex-shrink-0 {
                animation: pulse 2s infinite;
            }
        </style>

        <!-- Error Message -->
        <div id="errorMessage" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">Tracking number not found. Please enter a valid tracking number.</span>
        </div>
    </div>
</section>

<!-- Footer -->
<?php include 'footer.php'; ?>

<!-- Google Maps API -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNLrJhOMz6idD05pzwk17mcLQHcBBG9k8&callback=initMap" async defer></script>

<!-- Custom JS -->
<script src="js/tracking.js"></script>

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
    
    // Initialize map for a specific shipment
    function initializeMap(shipment) {
        if (typeof google !== 'undefined' && typeof google.maps !== 'undefined') {
            // Clear previous markers and routes
            if (window.markers) {
                window.markers.forEach(marker => marker.setMap(null));
                window.markers = [];
            }
            
            if (window.directionsRenderer) {
                window.directionsRenderer.setDirections({routes: []});
            }
            
            const origin = shipment.current_coordinates;
            const destination = shipment.destination_coordinates;
            
            // Initialize map if not already initialized
            if (!window.map) {
                const indiaCenter = { lat: 20.5937, lng: 78.9629 };
                window.map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 5,
                    center: indiaCenter
                });
                
                window.directionsService = new google.maps.DirectionsService();
                window.directionsRenderer = new google.maps.DirectionsRenderer({
                    map: window.map,
                    suppressMarkers: true,
                    polylineOptions: {
                        strokeColor: '#4285F4',
                        strokeWeight: 5,
                        strokeOpacity: 0.8
                    }
                });
                
                window.markers = [];
            }
            
            // Add markers
            addMapMarker(
                origin, 
                'Current Location', 
                'https://maps.google.com/mapfiles/ms/icons/blue-dot.png',
                shipment.current_location
            );
            
            addMapMarker(
                destination, 
                'Destination', 
                'https://maps.google.com/mapfiles/ms/icons/red-dot.png',
                shipment.destination
            );
            
            // Draw route if origin and destination are different
            if (origin.lat !== destination.lat || origin.lng !== destination.lng) {
                const request = {
                    origin: origin,
                    destination: destination,
                    travelMode: 'DRIVING'
                };
                
                window.directionsService.route(request, function(result, status) {
                    if (status == 'OK') {
                        window.directionsRenderer.setDirections(result);
                        
                        // Fit map to show the entire route
                        const bounds = new google.maps.LatLngBounds();
                        bounds.extend(origin);
                        bounds.extend(destination);
                        window.map.fitBounds(bounds);
                    } else {
                        // If route calculation fails, just show both points
                        const bounds = new google.maps.LatLngBounds();
                        bounds.extend(origin);
                        bounds.extend(destination);
                        window.map.fitBounds(bounds);
                    }
                });
            } else {
                // If origin and destination are the same, center on that location
                window.map.setCenter(origin);
                window.map.setZoom(12);
            }
        }
    }
    
    // Add marker to map with info window
    function addMapMarker(position, title, iconUrl, content) {
        if (!window.map || !window.markers) return;
        
        const marker = new google.maps.Marker({
            position: position,
            map: window.map,
            title: title,
            icon: {
                url: iconUrl,
                scaledSize: new google.maps.Size(40, 40)
            },
            animation: google.maps.Animation.DROP
        });
        
        // Add info window with content
        if (content) {
            const infoWindow = new google.maps.InfoWindow({
                content: `<div class="p-2"><strong>${title === 'Current Location' ? 'Current Location' : 'Destination'}:</strong><br>${content}</div>`,
                maxWidth: 250
            });
            
            marker.addListener('click', function() {
                infoWindow.open(window.map, marker);
            });
            
            // Auto open info window for current location
            if (title === 'Current Location') {
                setTimeout(() => {
                    infoWindow.open(window.map, marker);
                }, 1000);
            }
        }
        
        window.markers.push(marker);
        return marker;
    }

    // Tracking form handling
    const trackingForm = document.getElementById('trackingForm');
    const trackingResults = document.getElementById('trackingResults');
    const displayTrackingNumber = document.getElementById('displayTrackingNumber');
    const statusBadge = document.getElementById('statusBadge');
    const estimatedDelivery = document.getElementById('estimatedDelivery');
    const currentLocation = document.getElementById('currentLocation');
    const destination = document.getElementById('destination');
    const customerName = document.getElementById('customerName');
    const customerContact = document.getElementById('customerContact');
    const trackingTimeline = document.getElementById('trackingTimeline');
    const errorMessage = document.getElementById('errorMessage');

    trackingForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const trackingNumber = document.getElementById('trackingNumber').value.trim();
        if (!trackingNumber) {
            alert('Please enter a tracking number');
            return;
        }
        
        // Show loading state
        document.getElementById('searchButton').disabled = true;
        document.getElementById('searchButton').innerHTML = '<div class="animate-spin h-5 w-5 border-2 border-white border-t-transparent rounded-full mx-auto"></div>';
        document.getElementById('errorMessage').classList.add('hidden');
        document.getElementById('trackingResults').classList.add('hidden');
        
        // Remove any existing package details section
        const existingPackageDetails = document.querySelector('.package-details-section');
        if (existingPackageDetails) {
            existingPackageDetails.remove();
        }
        
        try {
            const response = await fetch('data/tracking.json');
            const data = await response.json();
            
            const shipment = data.shipments.find(s => s.tracking_id === trackingNumber);
            
            if (shipment) {
                // Update tracking information
                displayTrackingNumber.textContent = shipment.tracking_id;
                statusBadge.textContent = shipment.status;
                estimatedDelivery.textContent = new Date(shipment.estimated_delivery).toLocaleDateString();
                currentLocation.textContent = shipment.current_location;
                destination.textContent = shipment.destination;
                customerName.textContent = shipment.customer_name;
                customerContact.textContent = shipment.contact;

                // Set status badge color
                statusBadge.className = 'px-4 py-2 rounded-full text-white ';
                switch(shipment.status.toLowerCase()) {
                    case 'delivered':
                        statusBadge.classList.add('bg-green-500');
                        break;
                    case 'in transit':
                        statusBadge.classList.add('bg-blue-500');
                        break;
                    case 'processing':
                        statusBadge.classList.add('bg-yellow-500');
                        break;
                    case 'out for delivery':
                        statusBadge.classList.add('bg-orange-500');
                        break;
                    default:
                        statusBadge.classList.add('bg-gray-500');
                }
                
                // Add package details section
                const packageDetailsSection = document.createElement('div');
                packageDetailsSection.className = 'bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mt-8';
                packageDetailsSection.innerHTML = `
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Package Details</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-blue-50 dark:bg-gray-700 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Weight</h3>
                            <p class="text-xl font-medium text-blue-600 dark:text-blue-400">${shipment.package_details.weight}</p>
                        </div>
                        <div class="bg-blue-50 dark:bg-gray-700 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Dimensions</h3>
                            <p class="text-xl font-medium text-blue-600 dark:text-blue-400">${shipment.package_details.dimensions}</p>
                        </div>
                        <div class="bg-blue-50 dark:bg-gray-700 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Type</h3>
                            <p class="text-xl font-medium text-blue-600 dark:text-blue-400">${shipment.package_details.type}</p>
                        </div>
                    </div>
                `;
                document.querySelector('.max-w-7xl.mx-auto.px-4.sm\\:px-6.lg\\:px-8').appendChild(packageDetailsSection);
                
                // Clear previous timeline
                trackingTimeline.innerHTML = '';
                
                // Add timeline items with animation
                shipment.updates.reverse().forEach((update, index) => {
                    const timelineItem = document.createElement('div');
                    timelineItem.className = 'flex items-start mb-8 opacity-0 transform translate-y-4';
                    
                    // Set different colors based on status
                    let statusColor = 'bg-blue-500';
                    switch(update.status.toLowerCase()) {
                        case 'delivered':
                            statusColor = 'bg-green-500';
                            break;
                        case 'in transit':
                            statusColor = 'bg-blue-500';
                            break;
                        case 'processing':
                            statusColor = 'bg-yellow-500';
                            break;
                        case 'out for delivery':
                            statusColor = 'bg-orange-500';
                            break;
                        case 'shipment picked up':
                            statusColor = 'bg-purple-500';
                            break;
                        default:
                            statusColor = 'bg-gray-500';
                    }
                    
                    timelineItem.innerHTML = `
                        <div class="flex-shrink-0 w-8 h-8 rounded-full ${statusColor} flex items-center justify-center">
                            <i class="fas fa-check text-white text-sm"></i>
                        </div>
                        <div class="ml-4 flex-grow">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">${update.status}</h3>
                                <span class="text-sm text-gray-500 dark:text-gray-400">${new Date(update.timestamp).toLocaleString()}</span>
                            </div>
                            <p class="text-gray-600 dark:text-gray-300 mt-1">${update.location}</p>
                            <p class="text-gray-600 dark:text-gray-300 mt-1 italic">${update.notes}</p>
                        </div>
                    `;
                    trackingTimeline.appendChild(timelineItem);
                    
                    // Animate timeline items
                    setTimeout(() => {
                        timelineItem.style.transition = 'all 0.5s ease-out';
                        timelineItem.style.opacity = '1';
                        timelineItem.style.transform = 'translateY(0)';
                    }, index * 200);
                });
                
                // Show results and hide error with animation
                trackingResults.classList.remove('hidden');
                errorMessage.classList.add('hidden');
                
                // Initialize map if Google Maps API is loaded
                initializeMap(shipment);
                
                // Animate the results section with GSAP
                gsap.from(trackingResults, {
                    opacity: 0,
                    y: 30,
                    duration: 0.8,
                    ease: "power3.out"
                });
                
                // Reset button state
                document.getElementById('searchButton').disabled = false;
                document.getElementById('searchButton').innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Track
                `;
                
                // Scroll to results
                trackingResults.scrollIntoView({ behavior: 'smooth' });
                
                // Initialize map if Google Maps API is loaded
                if (typeof google !== 'undefined' && typeof google.maps !== 'undefined') {
                    initializeMap(shipment);
                }
                
                // Animate the results section
                gsap.from(trackingResults, {
                    opacity: 0,
                    y: 30,
                    duration: 0.8,
                    ease: "power3.out"
                });
            } else {
                // Show error message with animation
                errorMessage.classList.remove('hidden');
                trackingResults.classList.add('hidden');
                
                // Animate error message
                gsap.from(errorMessage, {
                    opacity: 0,
                    y: 20,
                    duration: 0.5,
                    ease: "power3.out"
                });
                
                // Reset button state
                document.getElementById('searchButton').disabled = false;
                document.getElementById('searchButton').innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Track
                `;
            }
        } catch (error) {
            console.error('Error fetching tracking data:', error);
            errorMessage.classList.remove('hidden');
            trackingResults.classList.add('hidden');
            
            // Animate error message
            gsap.from(errorMessage, {
                opacity: 0,
                y: 20,
                duration: 0.5,
                ease: "power3.out"
            });
            
            // Reset button state
            document.getElementById('searchButton').disabled = false;
            document.getElementById('searchButton').innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                Track
            `;
        }
    });

    // Initial animations
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

    gsap.from('#trackingForm', {
        opacity: 0,
        y: 20,
        duration: 1,
        delay: 0.4,
        ease: "power3.out"
    });
</script>