@extends('admin.master') 
@section('content')

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
     <style>
        #map { height: 800px; width: 100%; }
        .coordinates-container {
            margin: 10px 0;
        }
        .coordinates-container label {
            display: inline-block;
            width: 100px;
        }
        .coordinates-container input {
            padding: 5px;
            margin: 5px 0;
            width: 200px;
        }
        #search-container {
            margin: 10px 0;
        }
        #search-input {
            padding: 8px;
            width: 70%;
            max-width: 400px;
        }
        button {
            padding: 8px 15px;
            margin: 5px;
            cursor: pointer;
        }
        #search-button {
            background: #4CAF50;
            color: white;
            border: none;
        }
        #search-button:hover {
            background: #45a049;
        }
        #copy-button {
            background: #2196F3;
            color: white;
            border: none;
        }
        #copy-button:hover {
            background: #0b7dda;
        }
        #load-button {
            background: #ff9800;
            color: white;
            border: none;
        }
        #load-button:hover {
            background: #e68a00;
        }
        #coordinates-array {
            width: 100%;
            height: 80px;
            padding: 8px;
            margin: 10px 0;
            font-family: monospace;
        }
    </style>
    <div class="main-container">
      <div class="page-header">
        <!-- Breadcrumb start -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Add Location</li>
        </ol>
        <!-- Breadcrumb end -->
    </div>
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    @include('admin.message')
                     @if(!empty($staff_id))@endif
                   
                     <form method="POST" action="{{ route('admin.update-hospital-map-location') }}" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="hospital_id" value="{{ $hospital->id }}">
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                  <div id="search-container">
                                <input type="text" id="search-input" placeholder="Search for a location (e.g., Paris, France)">
                                <button type="button" id="search-button">Search</button>
                            </div>
                            </div>

                               <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                 <div class="coordinates-container">
                                <label for="latitude">Latitude:</label>
                              <input type="text" id="latitude" name="latitude" readonly value="{{ $hospital->latitude }}">

                                <label for="longitude">Longitude:</label>
                               <input type="text" id="longitude" name="longitude" readonly value="{{ $hospital->longitude }}">
                            </div>
                         
                            </div>
                         
                             <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <button type="submit" class="btn btn-primary">Update Map Location</button>
                            </div>
                            
                    
                           
                        </div>
                    </form>
                       
                      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                 <div id="map"></div>
                             </div>
                                <div>
                        <label>Coordinates Array (JSON):</label><br>
                        <textarea id="coordinates-array" placeholder="e.g., [[28.6139, 77.2090], [19.0760, 72.8777]]"></textarea>
                        <button id="copy-button">Copy Coordinates</button>
                        <button id="load-button">Load Coordinates</button>
                    </div>
                 
                </div>
            </div>
        </div>

    </div>
</div>
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // Initialize map
          const initialLat = {{ $hospital->latitude ?? 28.6139 }};
          const initialLng = {{ $hospital->longitude ?? 77.2090 }};
           var map = L.map('map').setView([initialLat, initialLng], 12);
        //var map = L.map('map').setView([28.6139, 77.2090], 12);
        
        // Add tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        
        // Add initial marker
        //var marker = L.marker([28.6139, 77.2090]).addTo(map);
         var marker = L.marker([initialLat, initialLng]).addTo(map);
        // Initialize input fields with default values
         document.getElementById('latitude').value = initialLat.toFixed(6);
    document.getElementById('longitude').value = initialLng.toFixed(6);
    document.getElementById('coordinates-array').value = JSON.stringify([[initialLat, initialLng]], null, 2);

        
        // Click event to update marker and coordinates
        map.on('click', function(e) {
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;
        marker.setLatLng([lat, lng]);
        document.getElementById('latitude').value = lat.toFixed(6);
        document.getElementById('longitude').value = lng.toFixed(6);
        updateCoordinatesArray([lat, lng]);
    });

        // Search functionality
        document.getElementById('search-button').addEventListener('click', function() {
            const query = document.getElementById('search-input').value.trim();
            if (!query) return;

            // Use Nominatim (OpenStreetMap's search API)
            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        const lat = parseFloat(data[0].lat);
                        const lon = parseFloat(data[0].lon);
                        
                        // Update map view
                        map.setView([lat, lon], 14);
                        
                        // Update marker
                        marker.setLatLng([lat, lon]);
                        
                        // Update input fields
                        document.getElementById('latitude').value = lat.toFixed(6);
                        document.getElementById('longitude').value = lon.toFixed(6);
                        updateCoordinatesArray([lat, lon]);
                    } else {
                        alert("Location not found!");
                    }
                })
                .catch(error => {
                    console.error("Error fetching location:", error);
                    alert("Error searching for location.");
                });
        });

        // Update coordinates array in textarea
        // function updateCoordinatesArray2(coords) {
        //     let currentArray = [];
        //     try {
        //         currentArray = JSON.parse(document.getElementById('coordinates-array').value);
        //         if (!Array.isArray(currentArray)) currentArray = [];
        //     } catch (e) {
        //         currentArray = [];
        //     }
        //     currentArray.push(coords);
        //     document.getElementById('coordinates-array').value = JSON.stringify(currentArray, null, 2);
        // }
        function updateCoordinatesArray(coords) {
            let currentArray = []; // Always start fresh (clears old values)
            
            // Directly push the new coordinates
            currentArray.push(coords);

            // Set the new array as JSON in the textarea or input
            document.getElementById('coordinates-array').value = JSON.stringify(currentArray, null, 2);
        }
        // Copy coordinates to clipboard
        document.getElementById('copy-button').addEventListener('click', function() {
            const textarea = document.getElementById('coordinates-array');
            textarea.select();
            document.execCommand('copy');
            alert("Copied to clipboard!");
        });

        // Load coordinates from textarea
        document.getElementById('load-button').addEventListener('click', function() {
            try {
                const coordsArray = JSON.parse(document.getElementById('coordinates-array').value);
                if (!Array.isArray(coordsArray)) throw new Error("Invalid format");
                
                // Clear existing markers (if any)
                map.eachLayer(layer => {
                    if (layer instanceof L.Marker) {
                        map.removeLayer(layer);
                    }
                });
                
                // Add new markers
                coordsArray.forEach(coord => {
                    if (Array.isArray(coord) && coord.length === 2) {
                        L.marker([coord[0], coord[1]]).addTo(map);
                    }
                });
                
                // Zoom to fit all markers
                if (coordsArray.length > 0) {
                    const latLngs = coordsArray.map(coord => L.latLng(coord[0], coord[1]));
                    map.fitBounds(L.latLngBounds(latLngs));
                }
            } catch (e) {
                alert("Invalid coordinates format! Use [[lat, lng], [lat, lng], ...]");
            }
        });
    </script>
  
@endsection
