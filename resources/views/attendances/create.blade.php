@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('attendances/style.css') }}">
<script defer src="{{ asset('attendances/face-api.min.js') }}"></script>
<script defer src="{{ asset('attendances/script.js') }}"></script>

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

        <div class="card-footer">
            {!! Form::submit('Mark Attendance', ['class' => 'btn btn-primary']) !!}
            <a href="{{ route('attendances.index') }}" class="btn btn-default"> Cancel </a>
        </div>
        {!! Form::close() !!}
    </div>
</div>

<!-- Video element for webcam feed -->
<video id="video" width="600" height="450" autoplay></video>

<script>
    navigator.mediaDevices
    .getUserMedia({ video: true })
    .then((stream) => {
        const video = document.getElementById("video");
        video.srcObject = stream;
    })
    .catch((err) => {
        console.log("Error: " + err);
    });
</script>

@endsection
