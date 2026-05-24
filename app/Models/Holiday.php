<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $fillable = [
        'name',
        'date',
        'description',
        'is_global',
        'employee_ids',
    ];

    protected $casts = [
        'date' => 'date',
        'is_global' => 'boolean',
        'employee_ids' => 'array',
    ];
}
