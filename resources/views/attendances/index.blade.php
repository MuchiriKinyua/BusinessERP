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
            <div class="card-body p-0">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Employee ID</th>
                            <th>Check-In Time</th>
                            <th>Check-Out Time</th>
                            <th>Attendance Date</th>
                            <th>Over Time</th>
                            <th>Under Time</th>
                            <th>Face Verification</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attendances as $attendance)
                            <tr>
                                <td>{{ $attendance->id }}</td>
                                <td>{{ $attendance->employee->name ?? 'N/A' }}</td>
                                <td>{{ $attendance->check_in_time }}</td>
                                <td>{{ $attendance->check_out_time }}</td>
                                <td>{{ $attendance->attendance_date }}</td>
                                <td>{{ $attendance->over_time }}</td>
                                <td>{{ $attendance->under_time }}</td>
                                <td>
                                    @if ($attendance->verify_face === 'not_verified')
                                        <span class="badge bg-danger">Not Verified</span>
                                    @else
                                        <span class="badge bg-success">Verified</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($attendance->verify_face === 'not_verified')
                                    <button class="btn btn-warning" onclick="verifyFace()">
                                        Verify Face
                                    </button>

                                    @else
                                        <button class="btn btn-secondary" disabled>
                                            Verified
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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

                        // Calculate the distance between the user's location and the geofence center
                        const distance = getDistanceFromLatLonInMeters(userLatitude, userLongitude, geofenceLatitude, geofenceLongitude);

                        if (distance <= geofenceRadius) {
                            // User is within geofence, allow access to the form
                            window.location.href = "{{ route('attendances.create') }}";
                        } else {
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

        // JavaScript for verifying face
        function verifyFace(attendanceId) {
            $.ajax({
                url: `/attendances/${attendanceId}/verify-face`,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    alert('Face verified successfully!');
                    location.reload(); // Reload the page to show the updated status
                },
                error: function(response) {
                    alert('Error: ' + response.responseJSON.error);
                }
            });
        }
    </script>
@endsection
