<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    public $timestamps = false;
    protected $table = 'appointment';
    protected $primaryKey = 'appointmentId';

}
