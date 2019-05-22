<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkingHour extends Model
{
    public $timestamps = false;
    protected $table = 'working_hour';
    protected $primaryKey = 'working_hourId';
}
