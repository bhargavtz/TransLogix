let map;
let markers = [];
let directionsService;
let directionsRenderer;

// Initialize Google Maps
function initMap() {
    const indiaCenter = { lat: 20.5937, lng: 78.9629 };
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 5,
        center: indiaCenter
    });

    directionsService = new google.maps.DirectionsService();
    directionsRenderer = new google.maps.DirectionsRenderer({
        map: map,
        suppressMarkers: true
    });
}



document.getElementById('trackingForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const trackingId = document.getElementById('trackingNumber').value.trim();
    if (!trackingId) {
        alert('કૃપા કરીને ટ્રેકિંગ નંબર દાખલ કરો');
        return;
    }

    // Show loading state
    document.getElementById('searchButton').disabled = true;
    document.getElementById('searchButton').innerHTML = '<div class="animate-spin h-5 w-5 border-2 border-white border-t-transparent rounded-full mx-auto"></div>';
    document.getElementById('errorMessage').classList.add('hidden');
    document.getElementById('trackingResults').classList.add('hidden');

    try {
        const response = await fetch('data/tracking.json');
        const data = await response.json();
        const result = {
            success: false,
            data: null
        };
        
        const shipment = data.shipments.find(s => s.tracking_id === trackingId);
        if (shipment) {
            result.success = true;
            result.data = shipment;
        }

        if (result.success && result.data) {
            // Reset tracking results container
            const resultsContainer = document.getElementById('trackingResults');
            resultsContainer.style.opacity = '0';
            resultsContainer.classList.remove('hidden');
            
            // Show results with animation
            showTrackingResults(result.data);
            
            // Fade in results
            setTimeout(() => {
                resultsContainer.style.transition = 'opacity 0.5s ease-in-out';
                resultsContainer.style.opacity = '1';
            }, 100);
            
            document.getElementById('errorMessage').classList.add('hidden');
        } else {
            document.getElementById('errorMessage').classList.remove('hidden');
            document.getElementById('trackingResults').classList.add('hidden');
        }
    } catch (error) {
        console.error('Error fetching tracking data:', error);
        document.getElementById('errorMessage').classList.remove('hidden');
    } finally {
        // Reset button state
        document.getElementById('searchButton').disabled = false;
        document.getElementById('searchButton').innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>ટ્રેક કરો';
    }
});

// Display tracking results
function showTrackingResults(shipment) {
    // Update shipment details
    document.getElementById('displayTrackingNumber').textContent = shipment.tracking_id;
    document.getElementById('customerName').textContent = shipment.customer_name;
    document.getElementById('customerContact').textContent = shipment.contact;
    document.getElementById('currentLocation').textContent = shipment.current_location;
    document.getElementById('destination').textContent = shipment.destination;
    
    // Format date to local date format
    const deliveryDate = new Date(shipment.estimated_delivery);
    const formattedDate = deliveryDate.toLocaleDateString('gu-IN', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
    document.getElementById('estimatedDelivery').textContent = formattedDate;
    
    // Remove existing package details section if any
    const existingPackageDetails = document.querySelector('.package-details-section');
    if (existingPackageDetails) {
        existingPackageDetails.remove();
    }
    
    // Add package details section
    const packageDetailsSection = document.createElement('div');
    packageDetailsSection.className = 'bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mt-8 package-details-section';
    packageDetailsSection.innerHTML = `
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">પેકેજની વિગતો</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-blue-50 dark:bg-gray-700 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">વજન</h3>
                <p class="text-xl font-medium text-blue-600 dark:text-blue-400">${shipment.package_details.weight}</p>
            </div>
            <div class="bg-blue-50 dark:bg-gray-700 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">માપ</h3>
                <p class="text-xl font-medium text-blue-600 dark:text-blue-400">${shipment.package_details.dimensions}</p>
            </div>
            <div class="bg-blue-50 dark:bg-gray-700 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">પ્રકાર</h3>
                <p class="text-xl font-medium text-blue-600 dark:text-blue-400">${shipment.package_details.type}</p>
            </div>
        </div>
    `;
    document.querySelector('.max-w-7xl.mx-auto.px-4.sm\\:px-6.lg\\:px-8').appendChild(packageDetailsSection);

    // Update status badge
    const statusBadge = document.getElementById('statusBadge');
    // Translate status to Gujarati
    let statusInGujarati = shipment.status;
    switch(shipment.status) {
        case 'In Transit':
            statusInGujarati = 'પરિવહનમાં';
            statusBadge.classList.add('bg-blue-500');
            break;
        case 'Delivered':
            statusInGujarati = 'પહોંચાડી દીધેલ';
            statusBadge.classList.add('bg-green-500');
            break;
        case 'Processing':
            statusInGujarati = 'પ્રક્રિયામાં';
            statusBadge.classList.add('bg-yellow-500');
            break;
        case 'Out for Delivery':
            statusInGujarati = 'ડિલિવરી માટે નીકળેલ';
            statusBadge.classList.add('bg-orange-500');
            break;
        default:
            statusBadge.classList.add('bg-gray-500');
    }
    statusBadge.textContent = statusInGujarati;
    statusBadge.className = 'px-4 py-2 rounded-full text-white transform transition-all duration-300 hover:scale-105';
    
    // Update timeline
    const timeline = document.getElementById('trackingTimeline');
    timeline.innerHTML = '';
    
    // Sort updates by timestamp (newest first)
    const sortedUpdates = [...shipment.updates].sort((a, b) => {
        return new Date(b.timestamp) - new Date(a.timestamp);
    });
    
    sortedUpdates.forEach((update, index) => {
        const date = new Date(update.timestamp);
        const timelineItem = document.createElement('div');
        timelineItem.className = 'flex items-start mb-8 opacity-0 transform translate-y-4';
        
        // Translate status to Gujarati
        let statusInGujarati = update.status;
        let statusColor = 'bg-blue-500';
        switch(update.status) {
            case 'In Transit':
                statusInGujarati = 'પરિવહનમાં';
                statusColor = 'bg-blue-500';
                break;
            case 'Delivered':
                statusInGujarati = 'પહોંચાડી દીધેલ';
                statusColor = 'bg-green-500';
                break;
            case 'Processing':
                statusInGujarati = 'પ્રક્રિયામાં';
                statusColor = 'bg-yellow-500';
                break;
            case 'Out for Delivery':
                statusInGujarati = 'ડિલિવરી માટે નીકળેલ';
                statusColor = 'bg-orange-500';
                break;
            case 'Shipment Picked Up':
                statusInGujarati = 'શિપમેન્ટ લઈ લીધેલ';
                statusColor = 'bg-purple-500';
                break;
            default:
                statusColor = 'bg-gray-500';
        }
        
        // Format date in Gujarati locale
        const formattedDate = date.toLocaleDateString('gu-IN', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
        
        timelineItem.innerHTML = `
            <div class="flex-shrink-0 w-6 h-6 rounded-full ${statusColor} mt-2 transition-all duration-300 hover:scale-125 flex items-center justify-center">
                <span class="text-white text-xs font-bold">${index + 1}</span>
            </div>
            <div class="ml-4 flex-grow bg-gray-50 dark:bg-gray-800 p-4 rounded-lg shadow-sm">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">${statusInGujarati}</h3>
                    <span class="text-sm text-gray-500 dark:text-gray-400">${formattedDate}</span>
                </div>
                <p class="text-gray-600 dark:text-gray-300 mt-1">${update.notes}</p>
                <p class="text-gray-500 dark:text-gray-400 mt-1 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    ${update.location}
                </p>
            </div>
        `;
        timeline.appendChild(timelineItem);
        
        // Animate timeline items with staggered delay
        setTimeout(() => {
            timelineItem.style.transition = 'all 0.5s ease-out';
            timelineItem.style.opacity = '1';
            timelineItem.style.transform = 'translateY(0)';
        }, index * 150);
    });
    
    // Add connecting line between timeline items if there are multiple updates
    if (sortedUpdates.length > 1) {
        const timelineContainer = document.getElementById('trackingTimeline');
        
        // Remove any existing timeline line
        const existingLine = timelineContainer.querySelector('.timeline-line');
        if (existingLine) {
            existingLine.remove();
        }
        
        const timelineLine = document.createElement('div');
        timelineLine.className = 'timeline-line absolute left-3 top-6 bottom-6 w-0.5 bg-gray-200 dark:bg-gray-700 z-0';
        timelineContainer.classList.add('relative');
        timelineContainer.prepend(timelineLine);
    }

    // Update map
    clearMarkers();
    const origin = shipment.current_coordinates;
    const destination = shipment.destination_coordinates;

    // Add markers with custom icons
    addMarker(
        origin, 
        'વર્તમાન સ્થાન', 
        {
            url: 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png',
            scaledSize: new google.maps.Size(40, 40)
        },
        '<div class="p-2"><strong>વર્તમાન સ્થાન:</strong><br>' + shipment.current_location + '</div>'
    );
    
    addMarker(
        destination, 
        'ગંતવ્ય સ્થાન', 
        {
            url: 'https://maps.google.com/mapfiles/ms/icons/red-dot.png',
            scaledSize: new google.maps.Size(40, 40)
        },
        '<div class="p-2"><strong>ગંતવ્ય સ્થાન:</strong><br>' + shipment.destination + '</div>'
    );

    // Draw route if origin and destination are different
    if (origin.lat !== destination.lat || origin.lng !== destination.lng) {
        const request = {
            origin: origin,
            destination: destination,
            travelMode: 'DRIVING'
        };

        directionsService.route(request, function(result, status) {
            if (status == 'OK') {
                // Set custom route styling
                directionsRenderer.setOptions({
                    polylineOptions: {
                        strokeColor: '#4285F4',
                        strokeWeight: 5,
                        strokeOpacity: 0.8
                    }
                });
                directionsRenderer.setDirections(result);
                
                // Fit map to show the entire route
                const bounds = new google.maps.LatLngBounds();
                bounds.extend(origin);
                bounds.extend(destination);
                map.fitBounds(bounds);
            } else {
                // If route calculation fails, just show both points
                const bounds = new google.maps.LatLngBounds();
                bounds.extend(origin);
                bounds.extend(destination);
                map.fitBounds(bounds);
            }
        });
    } else {
        directionsRenderer.setDirections({ routes: [] });
        map.setCenter(origin);
        map.setZoom(12);
    }
}

// Add marker to map with info window
function addMarker(position, title, icon, content) {
    const marker = new google.maps.Marker({
        position: position,
        map: map,
        title: title,
        icon: icon,
        animation: google.maps.Animation.DROP
    });
    
    // Add info window with content
    if (content) {
        const infoWindow = new google.maps.InfoWindow({
            content: content,
            maxWidth: 250
        });
        
        marker.addListener('click', function() {
            infoWindow.open(map, marker);
        });
        
        // Auto open info window for current location
        if (title.includes('Current Location')) {
            setTimeout(() => {
                infoWindow.open(map, marker);
            }, 1000);
        }
    }
    
    markers.push(marker);
    return marker;
}

// Clear all markers from map
function clearMarkers() {
    markers.forEach(marker => marker.setMap(null));
    markers = [];
}

// Initialize map when page loads
window.addEventListener('load', initMap);

// Tracking Management Functions

// Generate new tracking ID
function generateTrackingID() {
    const prefix = 'TL';
    const timestamp = Date.now().toString().slice(-6);
    const random = Math.floor(Math.random() * 1000).toString().padStart(3, '0');
    return `${prefix}${timestamp}${random}`;
}

// Add new shipment
async function addShipment(shipmentData) {
    try {
        const response = await fetch('data/tracking.json');
        const data = await response.json();
        
        // Generate new tracking ID
        const trackingId = generateTrackingID();
        
        // Create new shipment object
        const newShipment = {
            tracking_id: trackingId,
            status: 'Processing',
            current_location: shipmentData.origin,
            destination: shipmentData.destination,
            estimated_delivery: shipmentData.estimated_delivery,
            customer_name: shipmentData.customer_name,
            contact: shipmentData.contact,
            package_details: {
                weight: shipmentData.weight,
                dimensions: shipmentData.dimensions,
                type: shipmentData.type
            },
            updates: [
                {
                    timestamp: new Date().toISOString(),
                    location: shipmentData.origin,
                    status: 'Processing',
                    notes: 'Shipment created'
                }
            ]
        };
        
        // Add to shipments array
        data.shipments.push(newShipment);
        
        // Save updated data
        await saveTrackingData(data);
        
        return trackingId;
    } catch (error) {
        console.error('Error adding shipment:', error);
        throw error;
    }
}

// Update shipment status
async function updateShipmentStatus(trackingId, status, location, notes) {
    try {
        const response = await fetch('data/tracking.json');
        const data = await response.json();
        
        const shipment = data.shipments.find(s => s.tracking_id === trackingId);
        if (!shipment) throw new Error('Shipment not found');
        
        // Update status and location
        shipment.status = status;
        shipment.current_location = location;
        
        // Add new update
        shipment.updates.push({
            timestamp: new Date().toISOString(),
            location: location,
            status: status,
            notes: notes
        });
        
        // Save updated data
        await saveTrackingData(data);
        
        return true;
    } catch (error) {
        console.error('Error updating shipment:', error);
        throw error;
    }
}

// Save tracking data
async function saveTrackingData(data) {
    try {
        const response = await fetch('data/tracking.json', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data, null, 4)
        });
        
        if (!response.ok) throw new Error('Failed to save tracking data');
        
        return true;
    } catch (error) {
        console.error('Error saving tracking data:', error);
        throw error;
    }
}

// Get all shipments
async function getAllShipments() {
    try {
        const response = await fetch('data/tracking.json');
        const data = await response.json();
        return data.shipments;
    } catch (error) {
        console.error('Error getting shipments:', error);
        throw error;
    }
}

// Search shipments
async function searchShipments(query) {
    try {
        const shipments = await getAllShipments();
        return shipments.filter(shipment => 
            shipment.tracking_id.toLowerCase().includes(query.toLowerCase()) ||
            shipment.customer_name.toLowerCase().includes(query.toLowerCase()) ||
            shipment.current_location.toLowerCase().includes(query.toLowerCase()) ||
            shipment.destination.toLowerCase().includes(query.toLowerCase())
        );
    } catch (error) {
        console.error('Error searching shipments:', error);
        throw error;
    }
}