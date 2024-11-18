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
