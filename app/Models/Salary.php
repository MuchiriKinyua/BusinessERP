<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    public $table = 'salaries';

    public $fillable = [
        'employee_id',
        'basic_salary',
        'bonus',
        'deductions',
        'net_salary',
        'pay_date'
    ];

    protected $casts = [
        'basic_salary' => 'string',
        'bonus' => 'string',
        'deductions' => 'string',
        'net_salary' => 'string',
        'pay_date' => 'datetime'
    ];

    public static array $rules = [
        'employee_id' => 'nullable',
        'basic_salary' => 'nullable|string|max:50',
        'bonus' => 'nullable|string|max:50',
        'deductions' => 'nullable|string|max:50',
        'net_salary' => 'nullable|string|max:50',
        'pay_date' => 'required'
    ];

    
}
