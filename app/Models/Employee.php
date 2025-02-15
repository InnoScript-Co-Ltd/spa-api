<?php

namespace App\Models;

use App\Traits\SnowflakeID;
use App\Traits\BasicAudit;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use SnowflakeID, BasicAudit, SoftDeletes;

    protected $tables = "employees";

    protected $fillables = [
        "user_id",
        "employee_no",
        "name",
        "phone",
        "date",
        "nrc",
        "nrc_front",
        "nrc_back",
        "address",
        "father_name",
        "mother_name",
        "join_date",
        "leave_date",
        "remark"
    ];

    protected $casts = [
        "date" => "date",
        "join_date" => "datetime",
        "leave_date" => "datetime",
    ];
}
