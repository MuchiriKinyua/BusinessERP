@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                    Create Employees
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'employees.store']) !!}

            <div class="card-body">

                <div class="row">
                    @include('employees.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('employees.index') }}" class="btn btn-default"> Cancel </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
    <script>
    // Access the camera and stream it to the video element
    navigator.mediaDevices.getUserMedia({ video: true })
    .then(stream => {
        document.getElementById('video').srcObject = stream;
    })
    .catch(err => {
        alert('Error accessing the camera: ' + err.message);
    });


    // Capture the image from the video feed
// Capture the image from the video feed
document.getElementById('capture').addEventListener('click', function() {
    const canvas = document.getElementById('canvas');
    const video = document.getElementById('video');
    const hiddenInput = document.getElementById('stored_face_image_path');

    canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
    
    // Convert the canvas image to base64 and store it in the hidden input
    const imageData = canvas.toDataURL('image/png');
    hiddenInput.value = imageData;  // Set the Base64 data in the hidden input

    alert('Face captured successfully!');
});

</script>

@endsection
