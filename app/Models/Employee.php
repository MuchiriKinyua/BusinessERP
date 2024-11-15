<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public $timestamps = true; 

    public $table = 'employees';

    public $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'physical_address',
        'department',
        'hire_date',
        'salary',
        'disability_status',
        'job_basis',
        'emergency_contact',
        'stored_face_image_path'
    ];

    protected $casts = [
        'first_name' => 'string',
        'last_name' => 'string',
        'email' => 'string',
        'physical_address' => 'string',
        'department' => 'string',
        'hire_date' => 'datetime',
        'salary' => 'string',
        'disability_status' => 'string',
        'job_basis' => 'string',
        'emergency_contact' => 'string',
        'stored_face_image_path' => 'string'
    ];

    public static array $rules = [
        'first_name' => 'nullable|string|max:50',
        'last_name' => 'nullable|string|max:50',
        'email' => 'nullable|string|max:50',
        'phone_number' => 'nullable',
        'physical_address' => 'nullable|string|max:100',
        'department' => 'nullable|string|max:50',
        'hire_date' => 'nullable',
        'salary' => 'nullable|string|max:50',
        'disability_status' => 'nullable|string|max:50',
        'job_basis' => 'nullable|string|max:50',
        'emergency_contact' => 'nullable|string|max:50',
        'created_at' => 'required',
        'updated_at' => 'required',
        'stored_face_image_path' => 'required|string|max:250'
    ];

    
}
