<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Off extends Model
{
    public $table = 'offs';

    public $fillable = [
        'off_name',
        'duration',
        'paid',
        'off_condition'
    ];

    protected $casts = [
        'off_name' => 'string',
        'duration' => 'string',
        'paid' => 'string',
        'off_condition' => 'string'
    ];

    public static array $rules = [
        'off_name' => 'nullable|string|max:50',
        'duration' => 'nullable|string|max:20',
        'paid' => 'nullable|string|max:20',
        'off_condition' => 'nullable|string|max:50'
    ];

    
}
