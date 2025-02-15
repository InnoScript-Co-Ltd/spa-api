<?php

namespace App\Models;

use App\Traits\BasicAudit;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Ladies extends Model
{
    use BasicAudit, SoftDeletes;

    protected $table = 'ladies';

    protected $fillable = [
        'profile',
        'name',
        'nrc',
        'phone',
        'dob',
        'address',
        'join_date',
        'leave_date',
    ];

    protected $casts = [
        'dob' => 'date',
        'join_date' => 'datetime',
        'leave_date' => 'datetime',
    ];
}
