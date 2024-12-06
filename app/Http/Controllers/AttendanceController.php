<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\AttendanceRepository;
use SomeFaceRecognitionLibrary;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use SimpleFacerec;
use Flash;

class AttendanceController extends Controller
{

    private $geofenceCenter = ['lat' => -1.2822546, 'lng' => 36.8944984];
    private $geofenceRadius = 1000000;

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
        // Fetch all employees for the dropdown with full name
        $employees = Employee::pluck(DB::raw("CONCAT(first_name, ' ', last_name)"), 'id');
    
        return view('attendances.create')->with('employees', $employees);
    }
    

    /**
     * Store a newly created Attendance in storage.
     */
    public function store(Request $request)
{
    $input = $request->all();
    
    // Check if a face image is provided (base64 encoded)
    if (!empty($input['stored_face_image_path'])) {
        $imageData = $input['stored_face_image_path'];
        
        // Fetch the employee name based on the selected employee_id
        $employee = Employee::find($input['employee_id']);
        if ($employee) {
            // Capitalize first and last name properly
            $capitalizedFirstName = ucfirst(strtolower($employee->first_name));
            $capitalizedLastName = ucfirst(strtolower($employee->last_name));
    
            // Replace spaces with underscores (safe for filenames)
            $sanitizedFirstName = preg_replace('/\s+/', '_', $capitalizedFirstName);
            $sanitizedLastName = preg_replace('/\s+/', '_', $capitalizedLastName);
    
            // Combine into file name
            $imageName = $sanitizedFirstName . '_' . $sanitizedLastName . '.png'; // Example: Muchiri_Kinyua.png
    
            $filePath = 'public/face_images/' . $imageName;
    
            // Decode the Base64 string and save the image to the storage
            $imageContent = base64_decode(str_replace('data:image/png;base64,', '', $imageData));
    
            // Save the image to storage
            Storage::put($filePath, $imageContent);
    
            // Update the input with the stored image path (save the relative path)
            $input['stored_face_image_path'] = 'storage/face_images/' . $imageName;
        }
    } else {
        $input['stored_face_image_path'] = null; // Explicitly set to null if no image
    }

    // Continue with saving other attendance data, and return response as needed
    // Example: Attendance::create($input);
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
    
}