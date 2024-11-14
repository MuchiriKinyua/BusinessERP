<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    public $table = 'promotions';

    public $fillable = [
        'employee_id',
        'previous_position',
        'new_position',
        'promotion_date',
        'previous_salary',
        'new_salary',
        'reason',
        'approved_by'
    ];

    protected $casts = [
        'previous_position' => 'string',
        'new_position' => 'string',
        'promotion_date' => 'datetime',
        'previous_salary' => 'string',
        'new_salary' => 'string',
        'reason' => 'string',
        'approved_by' => 'string'
    ];

    public static array $rules = [
        'employee_id' => 'nullable',
        'previous_position' => 'nullable|string|max:50',
        'new_position' => 'nullable|string|max:50',
        'promotion_date' => 'required',
        'previous_salary' => 'nullable|string|max:50',
        'new_salary' => 'nullable|string|max:50',
        'reason' => 'nullable|string|max:100',
        'approved_by' => 'nullable|string|max:50'
    ];

    
}
