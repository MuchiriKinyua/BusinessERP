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

    @push('page-scripts')
     <!-- Script to open camera and detect faces -->
    <script defer src="https://cdn.jsdelivr.net/npm/face-api.js"></script>
    <script>
        const cv = require('opencv4nodejs');
        const faceapi = require('@vladmandic/face-api');
        const { Canvas, Image, ImageData } = require('canvas');
        const path = require('path');

        // Patch face-api with Node.js canvas
        faceapi.env.monkeyPatch({ Canvas, Image, ImageData });

        (async () => {
        // Load face-api models
        const modelPath = path.join(__dirname, 'models'); // Folder where face-api models are stored
        await faceapi.nets.ssdMobilenetv1.loadFromDisk(modelPath);
        await faceapi.nets.faceRecognitionNet.loadFromDisk(modelPath);
        await faceapi.nets.faceLandmark68Net.loadFromDisk(modelPath);

        // Load reference face images and generate face descriptors
        const labeledFaceDescriptors = await Promise.all(
            ['person1', 'person2'].map(async (label) => {
            const imgPath = path.join(__dirname, 'public/storage/face_images', `${label}.jpg`);
            const img = await canvas.loadImage(imgPath);
            const detections = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor();
            if (!detections) {
                throw new Error(`No face detected for ${label}`);
            }
            return new faceapi.LabeledFaceDescriptors(label, [detections.descriptor]);
            })
        );

        const faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors);

        // Open webcam
        const webcam = new cv.VideoCapture(0);
        const delay = 10; // 10 ms delay for frame reading

        console.log('Press "ESC" to exit.');

        while (true) {
            const frame = webcam.read();
            const resizedFrame = frame.resize(480, 640); // Resize frame for better performance

            // Convert OpenCV Mat to a Canvas Image
            const frameCanvas = cv.imencode('.jpg', resizedFrame).toString('base64');
            const img = await canvas.loadImage(`data:image/jpeg;base64,${frameCanvas}`);

            // Detect faces in the frame
            const detections = await faceapi.detectAllFaces(img).withFaceLandmarks().withFaceDescriptors();
            const results = detections.map((d) => faceMatcher.findBestMatch(d.descriptor));

            results.forEach((result, i) => {
            const { box } = detections[i].detection;
            const { x, y, width, height } = box;
            const label = result.toString();

            // Draw the bounding box and label on the frame
            frame.drawRectangle(
                new cv.Rect(x, y, width, height),
                new cv.Vec(0, 0, 255), // Red box
                2
            );
            frame.putText(label, new cv.Point2(x, y - 10), cv.FONT_HERSHEY_SIMPLEX, 0.5, new cv.Vec(255, 255, 255), 2);
            });

            // Display the frame
            cv.imshow('Webcam', frame);

            const key = cv.waitKey(delay);
            if (key === 27) break; // Exit on "ESC" key
        }

        webcam.release();
        cv.destroyAllWindows();
        })();

    </script>
    @endpush

@endsection
