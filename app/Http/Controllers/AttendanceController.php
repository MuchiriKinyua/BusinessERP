<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\AttendanceRepository;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use App\Models\Employee;
use Flash;

class AttendanceController extends Controller
{
    private $geofenceCenter = ['lat' => -1.2822546, 'lng' => 36.8944984];
    private $geofenceRadius = 1000;

    /** @var AttendanceRepository $attendanceRepository */
    private $attendanceRepository;

    public function __construct(AttendanceRepository $attendanceRepo)
    {
        $this->attendanceRepository = $attendanceRepo;
    }

    public function index(Request $request)
    {
        $attendances = $this->attendanceRepository->paginate(10);

        return view('attendances.index')->with('attendances', $attendances);
    }

    public function create()
    {
        // Fetch employees and create a full name attribute
        $employees = Employee::all()->mapWithKeys(function ($employee) {
            $fullName = $employee->first_name . ' ' . $employee->last_name;
            return [$employee->id => $fullName];
        });
    
        return view('attendances.create')->with('employees', $employees);
    }
    
    public function store(Request $request)
    {
        // Fetch the employee's face image from the database
        $employee = Employee::find($request->input('employee_id'));
    
        if (!$employee) {
            return redirect()->back()->withErrors(['Employee not found.']);
        }
    
        // Path to the employee's saved face image in the storage folder
        $employeeFaceImagePath = public_path('storage/face_images/' . $employee->face_image);
    
        // Check if the employee's face image exists
        if (!File::exists($employeeFaceImagePath)) {
            return redirect()->back()->withErrors(['No face image found for this employee.']);
        }
    
        // Capture the temporary face image uploaded by the user (this would need to be captured via frontend)
        $capturedFaceImagePath = public_path('storage/uploads/temp_captured_face.png');
    
        // Check if the captured face image exists
        if (!File::exists($capturedFaceImagePath)) {
            return redirect()->back()->withErrors(['Captured face image not found.']);
        }
    
        // Perform the face verification
        $verificationResult = $this->compareImages($employeeFaceImagePath, $capturedFaceImagePath);
    
        if (!$verificationResult) {
            return redirect()->back()->withErrors(['Face did not match our records.']);
        }
    
        // Proceed to store attendance if all conditions are met
        $attendance = $this->attendanceRepository->create($request->all());
        Flash::success('Attendance saved successfully.');
        return redirect(route('attendances.index'));
    }

    public function edit($id)
    {
        $attendance = $this->attendanceRepository->find($id);

        if (empty($attendance)) {
            Flash::error('Attendance not found');
            return redirect(route('attendances.index'));
        }

        return view('attendances.edit')->with('attendance', $attendance);
    }

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

        $request->validate([
            'employee_id' => 'required|exists:employees,id',
        ]);
        
    }

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
        $earthRadius = 6371000; // Earth radius in meters
        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLng / 2) * sin($dLng / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c; // Distance in meters
    }
    
    public function verifyFace(Request $request, $employeeId)
    {
        // Retrieve employee record from the database
        $employee = Employee::find($employeeId);
    
        if (!$employee) {
            \Log::error("Employee not found with ID: $employeeId");
            return response()->json(['error' => 'Employee not found.'], 404);
        }
    
        // Validate the uploaded image
        if (!$request->hasFile('image')) {
            \Log::error("No image uploaded for face verification.");
            return response()->json(['error' => 'No image uploaded.'], 400);
        }
    
        // Get the uploaded image
        $uploadedImage = $request->file('image');
    
        // Save the uploaded image temporarily in the public storage folder
        $temporaryImagePath = public_path('storage/uploads/temp_captured_face.png');
        $uploadedImage->move(public_path('storage/uploads'), 'temp_captured_face.png');
    
        // Path to the employee's saved face image in the storage folder
        $employeeFaceImagePath = public_path('storage/face_images/' . $employee->face_image);
    
        // Check if the employee's face image exists
        if (!File::exists($employeeFaceImagePath)) {
            \Log::error("No face image found for employee ID: $employeeId at path $employeeFaceImagePath");
            return response()->json(['error' => 'No face image found for this employee.'], 404);
        }
    
        // Perform face verification using the compareImages method
        $verificationResult = $this->compareImages($employeeFaceImagePath, $temporaryImagePath);
    
        // Log the result
        \Log::info("Face verification result: $verificationResult");
    
        // Return result based on verification
        if ($verificationResult) {
            return response()->json(['message' => 'Face verification successful.']);
        } else {
            return response()->json(['error' => 'Face did not match our records.'], 400);
        }
    }
    
    
    private function compareImages($image1Path, $image2Path)
    {
        // Ensure file paths are safe for shell command execution
        $safeImage1Path = escapeshellarg($image1Path);
        $safeImage2Path = escapeshellarg($image2Path);
    
        // Execute the Python script for face comparison
        $command = "python3 " . base_path('scripts/compare_faces.py') . " $safeImage1Path $safeImage2Path";
        
        // Run the command and capture the output
        $output = shell_exec($command);
    
        // Check if the output from Python script is "True" for successful face match
        return trim($output) === "True";
    }
    
    public function verify($employeeId)
    {
        // Fetch employee from the database
        $employee = Employee::find($employeeId);
    
        if (!$employee) {
            return response()->json(['error' => 'Employee not found'], 404);
        }
    
        // Path to the captured face image (uploaded by the client)
        $capturedFaceImagePath = public_path('storage/uploads/temp_captured_face.png');  
    
        // Path to the employee's stored face image
        $employeeFaceImagePath = public_path('storage/face_images/' . $employee->face_image);
    
        // Ensure the captured image exists
        if (!File::exists($capturedFaceImagePath)) {
            return response()->json(['error' => 'Captured face image not found.'], 400);
        }
    
        // Ensure the employee's face image exists
        if (!File::exists($employeeFaceImagePath)) {
            return response()->json(['error' => 'Employee face image not found.'], 404);
        }
    
        // Perform face comparison
        $isVerified = $this->compareImages($capturedFaceImagePath, $employeeFaceImagePath);
    
        // Return response based on verification result
        if ($isVerified === "True") {
            return response()->json(['message' => 'Face verification successful'], 200);
        } else {
            return response()->json(['error' => 'Face verification failed'], 400);
        }
    }
    
    

}
