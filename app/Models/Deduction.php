<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deduction extends Model
{
    public $table = 'deductions';

    public $fillable = [
        'employee_id',
        'deduction_type',
        'amount',
        'date_applied'
    ];

    protected $casts = [
        'deduction_type' => 'string',
        'date_applied' => 'datetime'
    ];

    public static array $rules = [
        'employee_id' => 'nullable',
        'deduction_type' => 'nullable|string|max:50',
        'amount' => 'nullable',
        'date_applied' => 'required'
    ];

    
}
