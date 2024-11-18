<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public $table = 'departments';

    public $fillable = [
        'department_name'
    ];

    protected $casts = [
        'department_name' => 'string'
    ];

    public static array $rules = [
        'department_name' => 'nullable|string|max:50'
    ];

    
}
