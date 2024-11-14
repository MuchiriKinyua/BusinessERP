@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2" style="display: flex; justify-content: space-between; align-items: center;">
                <div class="col-sm-6">
                    <h1>Attendances</h1>
                </div>
                <div class="col-sm-6" style="text-align: right;">
                    <button class="btn btn-primary float-right" onclick="checkGeofence()">
                        Add New
                    </button>
                    <!-- Add the Capture Face button next to the Add New button -->
                    <button id="captureFaceBtn" class="btn btn-primary" onclick="captureFace()"
                        style="background-color: #007bff; border: none; font-size: 18px; padding: 15px 25px; border-radius: 10px; position: relative; left: -600px;">
                        Capture Face for Attendance
                    </button>

                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            @include('attendances.table')
        </div>
    </div>

    <script>
        // Define the geofence coordinates and radius (in meters)
        const geofenceLatitude = -1.2822546;
        const geofenceLongitude = 36.8944984;
        const geofenceRadius = 1000; // Radius in meters

        // JavaScript for checking geofence on "Add New"
        function checkGeofence() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const userLatitude = position.coords.latitude;
                        const userLongitude = position.coords.longitude;

                        // Log the user's current position
                        console.log("User's Latitude: " + userLatitude);
                        console.log("User's Longitude: " + userLongitude);

                        // Calculate the distance between the user's location and the geofence center
                        const distance = getDistanceFromLatLonInMeters(userLatitude, userLongitude, geofenceLatitude, geofenceLongitude);

                        // Log the distance
                        console.log("Distance from geofence: " + distance + " meters");

                        if (distance <= geofenceRadius) {
                            // User is within geofence, allow access to the form
                            window.location.href = "{{ route('attendances.create') }}";
                        } else {
                            // Inform the user they are outside the geofence
                            alert("You are outside the allowed geofence area.");
                        }
                    },
                    function(error) {
                        if (error.code === error.PERMISSION_DENIED) {
                            alert("Location access is required to check attendance.");
                        } else {
                            alert("Error retrieving location: " + error.message);
                        }
                    }
                );
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        // Helper function to calculate distance between two latitude/longitude points in meters
        function getDistanceFromLatLonInMeters(lat1, lon1, lat2, lon2) {
            const R = 6371000; // Radius of the Earth in meters
            const dLat = (lat2 - lat1) * Math.PI / 180;
            const dLon = (lon2 - lon1) * Math.PI / 180;
            const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                        Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                        Math.sin(dLon / 2) * Math.sin(dLon / 2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            return R * c; // Distance in meters
        }
    </script>

    <!-- Add the video element to capture the face -->
    <video id="video" width="300" height="200" autoplay></video>
    <canvas id="canvas" style="display: none;"></canvas>

    <script>
        // Start the video stream for capturing the face
        function startVideo() {
            const video = document.getElementById('video');
            if (navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia({ video: true })
                    .then(function (stream) {
                        video.srcObject = stream;
                    })
                    .catch(function (error) {
                        console.log("Error accessing camera: " + error);
                    });
            }
        }

        // Capture the face image from the video stream
        function captureFace() {
            const video = document.getElementById('video');
            const canvas = document.getElementById('canvas');
            const ctx = canvas.getContext('2d');

            // Draw the current frame from the video onto the canvas
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

            // Get the image data from the canvas
            const faceImage = canvas.toDataURL('image/png');

            // Send the captured image to the backend for verification
            verifyFace(faceImage);
        }

        // Call the backend to verify the face image
        function verifyFace(faceImage) {
            fetch('{{ route('verify.face') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ face_image: faceImage }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Face verification successful!');
                    window.location.href = "{{ route('attendances.create') }}";
                } else {
                    alert('Face verification failed!');
                }
            })
            .catch(error => {
                console.error('Error during face verification:', error);
            });
        }

        // Start video when the page is loaded
        window.onload = startVideo;
    </script>

@endsection
