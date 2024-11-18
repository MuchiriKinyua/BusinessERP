<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\EmployeeRepository;
use Illuminate\Http\Request;
use Flash;

class EmployeeController extends AppBaseController
{
    /** @var EmployeeRepository $employeeRepository*/
    private $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepo)
    {
        $this->employeeRepository = $employeeRepo;
    }

    /**
     * Display a listing of the Employee.
     */
    public function index(Request $request)
    {
        $employees = $this->employeeRepository->paginate(10);

        return view('employees.index')
            ->with('employees', $employees);
    }

    /**
     * Show the form for creating a new Employee.
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created Employee in storage.
     */
    public function store(CreateEmployeeRequest $request)
    {
        $input = $request->all();
        
        // Handle face image (Base64 to file)
        if (!empty($input['stored_face_image_path'])) {
            $imageData = $input['stored_face_image_path'];
            
            // Use the first name and last name from the input to create the image name
            $imageName = $input['first_name'] . '_' . $input['last_name'] . '.png'; // Concatenate first and last name with an underscore
            $filePath = 'public/face_images/' . $imageName;
        
            // Decode Base64 string and save as an image
            $imageContent = base64_decode(str_replace('data:image/png;base64,', '', $imageData));
        
            // Save the image to storage
            Storage::put($filePath, $imageContent);
        
            // Update input with the stored image path (save the relative path)
            $input['stored_face_image_path'] = 'storage/face_images/' . $imageName;
        } else {
            $input['stored_face_image_path'] = null; // Explicitly set to null if no image
        }
        
        // Create the employee record
        $employee = $this->employeeRepository->create($input);
        
        Flash::success('Employee saved successfully.');
        
        return redirect(route('employees.index'));
    }
    
    
    /**
     * Display the specified Employee.
     */
    public function show($id)
    {
        $employee = $this->employeeRepository->find($id);

        if (empty($employee)) {
            Flash::error('Employee not found');

            return redirect(route('employees.index'));
        }

        return view('employees.show')->with('employee', $employee);
    }

    /**
     * Show the form for editing the specified Employee.
     */
    public function edit($id)
    {
        $employee = $this->employeeRepository->find($id);

        if (empty($employee)) {
            Flash::error('Employee not found');

            return redirect(route('employees.index'));
        }

        return view('employees.edit')->with('employee', $employee);
    }

    /**
     * Update the specified Employee in storage.
     */
    public function update($id, UpdateEmployeeRequest $request)
    {
        $employee = $this->employeeRepository->find($id);

        if (empty($employee)) {
            Flash::error('Employee not found');

            return redirect(route('employees.index'));
        }

        $employee = $this->employeeRepository->update($request->all(), $id);

        Flash::success('Employee updated successfully.');

        return redirect(route('employees.index'));
    }

    /**
     * Remove the specified Employee from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $employee = $this->employeeRepository->find($id);

        if (empty($employee)) {
            Flash::error('Employee not found');

            return redirect(route('employees.index'));
        }

        $this->employeeRepository->delete($id);

        Flash::success('Employee deleted successfully.');

        return redirect(route('employees.index'));
    }
}