<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeactiveAttendence extends Model
{
    protected $connection = 'kia_activity';
    protected $table = 'deactive_attendence';
    protected $fillable = [
        'activity_id',
        'status',
    ];
}
