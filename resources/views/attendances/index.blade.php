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
        const geofenceRadius = 1000000; // Radius in meters

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



@endsection