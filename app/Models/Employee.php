<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'employee_no',
        'name',
        'phone',
        'date',
        'nrc',
        'nrc_front',
        'nrc_back',
        'address',
        'father_name',
        'mother_name',
        'join_date',
        'leave_date',
        'remark',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'datetime',
        'join_date' => 'datetime',
        'leave_date' => 'datetime',
    ];

    /**
     * Automatically generate a UUID when creating a new Employee.
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($employee) {
            if (empty($employee->id)) {
                $employee->id = (string) Str::uuid();
            }
        });
    }

    /**
     * Relationship: Employee belongs to a User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
