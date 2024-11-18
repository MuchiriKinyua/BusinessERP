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
        const faceapi = require('@vladmandic/face-api');
        const { Canvas, Image, ImageData, createCanvas } = require('canvas');
        const fs = require('fs-extra');
        const path = require('path');

        // Monkey-patch face-api to use Node.js Canvas
        f       aceapi.env.monkeyPatch({ Canvas, Image, ImageData });

        (async () => {
        const modelPath = path.join(__dirname, 'models'); // Folder where face-api models are stored
        const videoPath = 'video.mp4'; // Path to your input video (can be webcam stream or pre-recorded video)
        
        // Load models
        await faceapi.nets.ssdMobilenetv1.loadFromDisk(modelPath);
        await faceapi.nets.faceLandmark68Net.loadFromDisk(modelPath);
        await faceapi.nets.faceRecognitionNet.loadFromDisk(modelPath);

        // Load labeled images for recognition
        const labeledDescriptors = await Promise.all(
            ['person1', 'person2'].map(async (label) => {
            const imgPath = path.join(__dirname, 'public/storage/face_images', `${label}.jpg`);
            const img = await faceapi.bufferToImage(fs.readFileSync(imgPath));
            const detection = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor();
            i   f (!detection) {
                t       hrow new Error(`No face detected for ${label}`);
            }
            return new faceapi.LabeledFaceDescriptors(label, [detection.descriptor]);
            })
        );

        const faceMatcher = new faceapi.FaceMatcher(labeledDescriptors);

        console.log('Processing video...');

        // Simulate video processing by reading frames from a video file
        const ffmpeg = require('fluent-ffmpeg');
        const outputFrames = path.join(__dirname, 'output'); // Directory to store processed frames
        await fs.ensureDir(outputFrames);

        // Extract frames and process each frame
        ffmpeg(videoPath)
            .       outputOptions('-vf', 'fps=1') // Extract one frame per second
            .output(path.join(outputFrames, 'frame-%03d.png'))
            .on('end', async () => {
            console.log('Frames extracted, processing faces...');

            const frames = await fs.readdir(outputFrames);
            
            for (const frameFile of frames) {
                const framePath = path.join(outputFrames, frameFile);
                const frame = await faceapi.bufferToImage(fs.readFileSync(framePath));
                const detections = await faceapi.detectAllFaces(frame).withFaceLandmarks().withFaceDescriptors();

                const canvas = createCanvas(frame.width, frame.height);
                const ctx = canvas.getContext('2d');
                ctx.drawImage(frame, 0, 0);

                detections.forEach((detection) => {
                const box = detection.detection.box;
                const match = faceMatcher.findBestMatch(detection.descriptor);
                ctx.strokeStyle = 'red';
                ctx.lineWidth = 2;
                ctx.strokeRect(box.x, box.y, box.width, box.height);
                ctx.fillStyle = 'red';
                ctx.font = '20px Arial';
                ctx.fillText(match.toString(), box.x, box.y - 10);
                });

                // Save processed frame
                const outputFilePath = path.join(outputFrames, `processed-${frameFile}`);
                fs.writeFileSync(outputFilePath, canvas.toBuffer('image/png'));
            }   

            console.log('Face recognition processing complete. Check the output folder for results.');
            })
            .run();
        })();

    </script>
    @endpush

@endsection
