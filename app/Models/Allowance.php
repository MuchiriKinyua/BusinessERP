<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Allowance extends Model
{
    public $table = 'allowances';

    public $fillable = [
        'employee_id',
        'allowance_type',
        'amount',
        'date_granted',
        'allowance_priviledge'
    ];

    protected $casts = [
        'allowance_type' => 'string',
        'amount' => 'string',
        'date_granted' => 'datetime',
        'allowance_priviledge' => 'string'
    ];

    public static array $rules = [
        'employee_id' => 'nullable',
        'allowance_type' => 'nullable|string|max:50',
        'amount' => 'nullable|string|max:50',
        'date_granted' => 'required',
        'allowance_priviledge' => 'nullable|string|max:50'
    ];

    
}
