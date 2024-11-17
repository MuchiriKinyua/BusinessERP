@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Create Attendance</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">
            <!-- Open the form for creating attendance -->
            {!! Form::open(['route' => 'attendances.store']) !!}

            <div class="card-body">
                <div class="row">
                    <!-- Face Verification Section at the top -->
                    <div class="form-group col-sm-12">
                        <label>Face Verification:</label>
                        <div>
                            <button type="button" class="btn btn-warning" id="verify-face-button" onclick="startCamera()">
                                Start Camera
                            </button>
                            <span id="verification-status" style="margin-left: 10px; color: red;">
                                Not Verified
                            </span>
                        </div>
                    </div>

                    <!-- Include the attendance fields -->
                    @include('attendances.fields')
                </div>
            </div>

            <div class="form-group col-sm-12">
                {!! Form::submit('Save', ['class' => 'btn btn-primary', 'id' => 'save-attendance-button', 'disabled' => true]) !!}
                <a href="{{ route('attendances.index') }}" class="btn btn-default">Cancel</a>
            </div>
        </div>

        <!-- Video element to display the webcam feed -->
        <div id="camera-container" style="display: none;">
            <video id="video" width="320" height="240" autoplay></video>
            <button type="button" class="btn btn-success" onclick="captureImage()">Capture Image</button>
            <canvas id="canvas" style="display: none;"></canvas>
        </div>
    </div>

    <script>
        let videoStream;

        // Function to start the camera
        function startCamera() {
            const employeeId = document.getElementById('employee_id').value;
            if (!employeeId) {
                alert("Please select an employee.");
                return;
            }

            // Access the webcam
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(function(stream) {
                    videoStream = stream;
                    const videoElement = document.getElementById('video');
                    videoElement.srcObject = stream;
                    document.getElementById('camera-container').style.display = 'block';
                    document.getElementById('verify-face-button').style.display = 'none'; // Hide the "Verify Face" button
                })
                .catch(function(error) {
                    console.log("Error accessing camera: ", error);
                    alert("Failed to start camera. Please check your device settings.");
                });
        }

        // Function to capture image from the video stream
        function captureImage() {
            const canvas = document.getElementById('canvas');
            const video = document.getElementById('video');
            const context = canvas.getContext('2d');

            // Draw the current frame of the video on the canvas
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            // Convert the canvas to a base64-encoded image
            const imageData = canvas.toDataURL('image/png');

            // Send the captured image to the server for verification
            verifyCapturedFace(imageData);
        }

        // Function to verify captured face
        function verifyCapturedFace(imageData) {
            const employeeId = document.getElementById('employee_id').value;
            if (!employeeId) {
                alert("Please select an employee.");
                return;
            }

            $.ajax({
                url: '/verify-face/' + employeeId,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    image: imageData, // Send the captured image
                },
                success: function(response) {
                    // Handle successful face verification
                    document.getElementById('verification-status').textContent = "Face verified successfully!";
                    document.getElementById('verification-status').style.color = "green";
                    document.getElementById('save-attendance-button').disabled = false;

                    // Stop the video stream after capture
                    videoStream.getTracks().forEach(track => track.stop());
                    document.getElementById('camera-container').style.display = 'none'; // Hide the camera
                },
                error: function(response) {
                    // Handle failed face verification
                    document.getElementById('verification-status').textContent = response.responseJSON.error || "Face verification failed.";
                    document.getElementById('verification-status').style.color = "red";
                    document.getElementById('save-attendance-button').disabled = true;
                }
            });
        }
    </script>

@endsection
