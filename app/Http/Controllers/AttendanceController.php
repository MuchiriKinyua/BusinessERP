<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\AttendanceRepository;
use SomeFaceRecognitionLibrary;
use Flash;

class AttendanceController extends Controller
{

    private $geofenceCenter = ['lat' => -1.2822546, 'lng' => 36.8944984];
    private $geofenceRadius = 100;

    /** @var AttendanceRepository $attendanceRepository*/
    private $attendanceRepository;

    public function __construct(AttendanceRepository $attendanceRepo)
    {
        $this->attendanceRepository = $attendanceRepo;
    }

    /**
     * Display a listing of the Attendance.
     */
    public function index(Request $request)
    {
        $attendances = $this->attendanceRepository->paginate(10);

        return view('attendances.index')
            ->with('attendances', $attendances);
    }

    /**
     * Show the form for creating a new Attendance.
     */
    public function create()
    {
        return view('attendances.create');
    }

    /**
     * Store a newly created Attendance in storage.
     */
    public function store(Request $request)
    {
        // No need to check the geofence again here
        // You can save the attendance data directly now
    
        $attendance = $this->attendanceRepository->create($request->all());
    
        Flash::success('Attendance marked successfully.');
        return redirect(route('attendances.index'));
    }    

    /**
     * Display the specified Attendance.
     */
    public function show($id)
    {
        $attendance = $this->attendanceRepository->find($id);

        if (empty($attendance)) {
            Flash::error('Attendance not found');

            return redirect(route('attendances.index'));
        }

        return view('attendances.show')->with('attendance', $attendance);
    }

    /**
     * Show the form for editing the specified Attendance.
     */
    public function edit($id)
    {
        $attendance = $this->attendanceRepository->find($id);

        if (empty($attendance)) {
            Flash::error('Attendance not found');

            return redirect(route('attendances.index'));
        }

        return view('attendances.edit')->with('attendance', $attendance);
    }

    /**
     * Update the specified Attendance in storage.
     */
    public function update($id, UpdateAttendanceRequest $request)
    {
        $attendance = $this->attendanceRepository->find($id);

        if (empty($attendance)) {
            Flash::error('Attendance not found');

            return redirect(route('attendances.index'));
        }

        $attendance = $this->attendanceRepository->update($request->all(), $id);

        Flash::success('Attendance updated successfully.');

        return redirect(route('attendances.index'));
    }

    /**
     * Remove the specified Attendance from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $attendance = $this->attendanceRepository->find($id);

        if (empty($attendance)) {
            Flash::error('Attendance not found');

            return redirect(route('attendances.index'));
        }

        $this->attendanceRepository->delete($id);

        Flash::success('Attendance deleted successfully.');

        return redirect(route('attendances.index'));
    }
    private function isWithinGeofence($latitude, $longitude)
    {
        $distance = $this->calculateDistance(
            $latitude, 
            $longitude, 
            $this->geofenceCenter['lat'], 
            $this->geofenceCenter['lng']
        );

        return $distance <= $this->geofenceRadius;
    }
    private function calculateDistance($lat1, $lng1, $lat2, $lng2)
{
    $earthRadius = 6371000; // Earth radius in meters (not kilometers)
    $dLat = deg2rad($lat2 - $lat1);
    $dLng = deg2rad($lng2 - $lng1);

    $a = sin($dLat / 2) * sin($dLat / 2) +
         cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
         sin($dLng / 2) * sin($dLng / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    
    return $earthRadius * $c; // Distance in meters
}
public function verifyFace(Request $request)
{
    $faceImage = $request->input('face_image');

    // Convert the base64 image to an image file
    $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $faceImage));
    $tempImagePath = storage_path('app/temp_face_image.png');
    file_put_contents($tempImagePath, $imageData);

    // Use a face recognition library to compare the captured face with the stored face data
    $employee = Employee::find(auth()->user()->id);  // Assuming you have employee logged in

    // Here you would integrate the face recognition process
    $isVerified = SomeFaceRecognitionLibrary::verifyFace($tempImagePath, $employee->stored_face_image_path);  // Example

    // Clean up the temporary image
    unlink($tempImagePath);

    if ($isVerified) {
        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false]);
}

}