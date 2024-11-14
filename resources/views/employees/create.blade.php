@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Check-In</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        @include('flash::message')

        <div class="card">
            <div class="card-body">
                <!-- Attendance Check-In Form -->
                <form action="{{ route('attendance.store') }}" method="POST">
                    @csrf
                    <!-- Hidden fields for coordinates -->
                    <input type="hidden" id="latitude" name="latitude">
                    <input type="hidden" id="longitude" name="longitude">
                    
                    <!-- Check-In Button -->
                    <button type="submit" class="btn btn-primary">Check In</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Geolocation Script -->
    <script>
        function getCurrentLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition((position) => {
                    document.getElementById('latitude').value = position.coords.latitude;
                    document.getElementById('longitude').value = position.coords.longitude;
                }, (error) => {
                    alert('Error obtaining location. Please enable location services.');
                });
            } else {
                alert('Geolocation is not supported by this browser.');
            }
        }

        // Call getCurrentLocation on page load
        window.onload = getCurrentLocation;
    </script>
@endsection
