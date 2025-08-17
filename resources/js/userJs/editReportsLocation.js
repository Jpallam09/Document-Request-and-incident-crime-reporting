document.addEventListener('DOMContentLoaded', () => {
    // Get DOM elements
    const mapControls = document.getElementById('mapControls');
    const mapPreview = document.getElementById('mapPreview');
    const coordsHelp = document.getElementById('coordsHelpPreview');
    const latitudeInput = document.getElementById('latitude');
    const longitudeInput = document.getElementById('longitude');
    const locateBtn = document.getElementById('locateBtn');

    // Parse initial coordinates
    const initialLat = parseFloat(latitudeInput.value);
    const initialLng = parseFloat(longitudeInput.value);

    // Initialize maps (controls + preview)
    const controlsMap = L.map(mapControls).setView(
        initialLat && initialLng ? [initialLat, initialLng] : [14.5995, 120.9842],
        initialLat && initialLng ? 15 : 13
    );
    const previewMap = L.map(mapPreview).setView(
        initialLat && initialLng ? [initialLat, initialLng] : [14.5995, 120.9842],
        initialLat && initialLng ? 15 : 13
    );

    // Add OpenStreetMap tiles to both
    [controlsMap, previewMap].forEach(m => {
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(m);
    });

    let markerControls, markerPreview;

    // Function to update everything when location changes
    const updateLocation = (lat, lng) => {
        latitudeInput.value = lat;
        longitudeInput.value = lng;

        // Update markers
        if (markerControls) {
            markerControls.setLatLng([lat, lng]);
        } else {
            markerControls = L.marker([lat, lng], { draggable: true }).addTo(controlsMap);
            // Add drag event once marker exists
            markerControls.on('dragend', (e) => {
                const { lat, lng } = e.target.getLatLng();
                updateLocation(lat, lng);
            });
        }

        if (markerPreview) {
            markerPreview.setLatLng([lat, lng]);
        } else {
            markerPreview = L.marker([lat, lng]).addTo(previewMap);
        }

        // Center preview map on new location
        previewMap.setView([lat, lng], 15);

        // Update text
        coordsHelp.textContent = `Latitude: ${lat.toFixed(6)}, Longitude: ${lng.toFixed(6)}`;
    };

    // If initial coords exist, place markers
    if (initialLat && initialLng) {
        updateLocation(initialLat, initialLng);
    } else {
        coordsHelp.textContent = "No location provided";
    }

    // Handle "Use My Location" button
    locateBtn.addEventListener('click', () => {
        if (!navigator.geolocation) {
            alert('Geolocation is not supported by your browser.');
            return;
        }

        navigator.geolocation.getCurrentPosition(
            (position) => {
                updateLocation(position.coords.latitude, position.coords.longitude);
                controlsMap.setView([position.coords.latitude, position.coords.longitude], 15);
            },
            () => {
                alert('Unable to get your location. Please allow location access.');
            }
        );
    });
});
