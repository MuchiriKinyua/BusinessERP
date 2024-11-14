<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    public $table = 'payrolls';

    public $fillable = [
        'employee_id',
        'salary_id',
        'payment_period',
        'total_earnings',
        'total_deductions',
        'net_pay',
        'payrolls_status',
        'payslip'
    ];

    protected $casts = [
        'payment_period' => 'datetime',
        'total_earnings' => 'string',
        'total_deductions' => 'string',
        'net_pay' => 'string',
        'payrolls_status' => 'string',
        'payslip' => 'string'
    ];

    public static array $rules = [
        'employee_id' => 'nullable',
        'salary_id' => 'nullable',
        'payment_period' => 'nullable',
        'total_earnings' => 'nullable|string|max:50',
        'total_deductions' => 'nullable|string|max:50',
        'net_pay' => 'nullable|string|max:50',
        'payrolls_status' => 'nullable|string|max:50',
        'payslip' => 'nullable|string|max:50'
    ];

    
}
