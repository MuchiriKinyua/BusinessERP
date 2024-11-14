<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documentation extends Model
{
    public $table = 'documentations';

    public $fillable = [
        'employee_id',
        'resume',
        'document_type',
        'document_name',
        'file_path'
    ];

    protected $casts = [
        'resume' => 'string',
        'document_type' => 'string',
        'document_name' => 'string',
        'file_path' => 'string'
    ];

    public static array $rules = [
        'employee_id' => 'nullable',
        'resume' => 'nullable|string|max:100',
        'document_type' => 'nullable|string|max:50',
        'document_name' => 'nullable|string|max:50',
        'file_path' => 'nullable|string|max:50'
    ];

    
}
