<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    public $table = 'leaves';

    public $fillable = [
        'employee_id',
        'leave_type_id',
        'department_id',
        'start_date',
        'end_date',
        'duration',
        'leave_status'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'duration' => 'string',
        'leave_status' => 'string'
    ];

    public static array $rules = [
        'employee_id' => 'nullable',
        'leave_type_id' => 'nullable',
        'department_id' => 'nullable',
        'start_date' => 'nullable',
        'end_date' => 'nullable',
        'duration' => 'nullable|string|max:20',
        'leave_status' => 'nullable|string|max:50'
    ];

    
}
