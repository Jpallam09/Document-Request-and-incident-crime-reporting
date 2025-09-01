document.addEventListener('DOMContentLoaded', () => {
    // Initialize map preview
    const map = L.map('mapPreview').setView([16.88122, 121.5878223], 13);

    // Add OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    let marker;

    // Function to update marker and hidden inputs
    function updateLocation(lat, lng) {
        if (marker) {
            marker.setLatLng([lat, lng]);
        } else {
            marker = L.marker([lat, lng], { draggable: true }).addTo(map);
            // Allow marker to be dragged to update coordinates
            marker.on('dragend', function(e) {
                const { lat, lng } = e.target.getLatLng();
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;
                document.getElementById('coordsHelpPreview').textContent = `Latitude: ${lat.toFixed(6)}, Longitude: ${lng.toFixed(6)}`;
            });
        }
        map.setView([lat, lng], 15);
        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;
        document.getElementById('coordsHelpPreview').textContent = `Latitude: ${lat.toFixed(6)}, Longitude: ${lng.toFixed(6)}`;
    }

    // Use My Location button
    document.getElementById('locateBtn').addEventListener('click', () => {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const { latitude, longitude } = position.coords;
                    updateLocation(latitude, longitude);
                },
                () => {
                    alert('Unable to get your location. Please allow location access.');
                }
            );
        } else {
            alert('Geolocation is not supported by your browser.');
        }
    });

    // Optional: click on map to select location manually
    map.on('click', function(e) {
        const { lat, lng } = e.latlng;
        updateLocation(lat, lng);
    });
});
