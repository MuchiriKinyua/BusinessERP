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
            {!! Form::open(['route' => 'attendances.store']) !!}
            <div class="card-body">
                <div class="row">
                    @include('attendances.fields')
                </div>
            </div>

                <!-- Open Camera Button -->
            <button type="button" class="btn btn-info" onclick="openCamera();">Open Camera</button>

            <div class="card-footer">
                {!! Form::submit('Mark Attendance', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('attendances.index') }}" class="btn btn-default"> Cancel </a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    <!-- Video element to show the camera feed -->
    <video id="video" width="640" height="480" autoplay></video>

    <script>
        function openCamera() {
            // Access the device's camera
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(function (stream) {
                    // Get the video element and set its source to the camera stream
                    var videoElement = document.getElementById('video');
                    videoElement.srcObject = stream;
                })
                .catch(function (error) {
                    console.log('Error accessing the camera: ', error);
                });
        }
    </script>
@endsection
