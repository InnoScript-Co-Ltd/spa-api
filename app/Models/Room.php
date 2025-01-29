<?php

namespace App\Models;

use App\Traits\SnowflakeID;
use App\Traits\BasicAudit;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use SnowflakeID, BasicAudit, SoftDeletes;

    protected $tables = "rooms";

    protected $fillable = [
        "room_number",
        "room_photos",
    ];
}
