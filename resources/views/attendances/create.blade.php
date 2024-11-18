@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                        Create Attendances
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        @include('adminlte-templates::common.errors')

        <div class="card">
            {!! Form::open(['route' => 'attendances.store']) !!}
            <div class="card-body">
                <div class="row">
                    @include('attendances.fields')
                </div>
            </div>
                <!-- Camera Section -->
    <div class="form-group col-sm-12">
        <label for="verify">Verify Your Face:</label>
        <div>
            <button type="button" id="openCameraButton" class="btn btn-primary">Open Camera</button>
            <video id="video" width="320" height="240" autoplay style="display:none;"></video>
        </div>
    </div>
            <script>
        // Access the camera when the button is clicked
        document.getElementById('openCameraButton').addEventListener('click', function() {
            // Show the video element and start the camera stream
            const video = document.getElementById('video');
            video.style.display = 'block'; // Show the video element
            
            navigator.mediaDevices.getUserMedia({ video: true })
            .then(stream => {
                video.srcObject = stream;
            })
            .catch(err => {
                alert('Error accessing camera: ' + err.message);
            });
        });
    </script>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('attendances.index') }}" class="btn btn-default"> Cancel </a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

     <!-- Script to open camera and detect faces -->
    <script defer src="https://cdn.jsdelivr.net/npm/face-api.js"></script>
    <script>
        async function loadLabeledImages() {
            const response = await fetch('http://localhost/api/employees');
            const employees = await response.json();
            console.log(employees)

            // Map employees to labels
            const labels = employees.map(employee => `${employee.first_name}_${employee.last_name}`);

            return Promise.all(
                labels.map(async (label) => {
                    const descriptions = [];
                    for (let i = 1; i <= 3; i++) {
                        const img = await faceapi.fetchImage(`/public/storage/face_images${label}/${i}.png`);
                        const detections = await faceapi.detectSingleFace(img)
                                                    .withFaceLandmarks()
                                                    .withFaceDescriptor();
                        descriptions.push(detections.descriptor);
                    }
                    return new faceapi.LabeledFaceDescriptors(label, descriptions);
                })
            );
        }
    </script>

@endsection