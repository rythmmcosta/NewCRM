<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'designation',
        'user_id',
        'father_name',
        'correspondence_address',
        'permanent_address',
        'telephone',
        'dob',
        'marital_status',
        'nid_number',
        'blood_group',
        'photograph',
        'emergency_contact',
        'educational_details',
        'employment_details',
        'family_details',
        'professional_references',
        'declaration_date',
        'declaration_place',
        'signature',
    ];

    protected $casts = [
        'emergency_contact' => 'array',
        'educational_details' => 'array',
        'employment_details' => 'array',
        'family_details' => 'array',
        'professional_references' => 'array',
        'dob' => 'date',
        'declaration_date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function roles(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->user->roles();
    }
}
