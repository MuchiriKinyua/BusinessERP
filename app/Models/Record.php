<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    public $table = 'records';

    public $fillable = [
        'employee_id',
        'record_type',
        'record_date',
        'record_description',
        'outcome',
        'comments',
        'handled_by'
    ];

    protected $casts = [
        'record_type' => 'string',
        'record_date' => 'datetime',
        'record_description' => 'string',
        'outcome' => 'string',
        'comments' => 'string',
        'handled_by' => 'string'
    ];

    public static array $rules = [
        'employee_id' => 'nullable',
        'record_type' => 'nullable|string|max:50',
        'record_date' => 'required',
        'record_description' => 'nullable|string|max:100',
        'outcome' => 'nullable|string|max:50',
        'comments' => 'nullable|string|max:200',
        'handled_by' => 'nullable|string|max:50'
    ];

    
}
