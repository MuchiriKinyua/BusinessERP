<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    public $table = 'attendances';

    public $fillable = [
        'id',
        'employee_id',
        'check_in_time',
        'check_out_time',
        'attendance_date',
        'over_time',
        'under_time',
        'verify_face',
    ];

    protected $casts = [
        'check_in_time' => 'datetime',
        'check_out_time' => 'datetime',
        'attendance_date' => 'datetime',
        'over_time' => 'datetime',
        'under_time' => 'datetime'
    ];

    public static array $rules = [
        'employee_id' => 'nullable',
        'check_in_time' => 'nullable',
        'check_out_time' => 'nullable',
        'attendance_date' => 'nullable',
        'over_time' => 'nullable',
        'under_time' => 'nullable',
        'created_at' => 'required',
        'updated_at' => 'required'
    ];

    public function employee()
{
    return $this->belongsTo(Employee::class);
}

}
