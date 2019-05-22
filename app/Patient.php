<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    public $timestamps = false;
    protected $table = 'patient';
    protected $primaryKey = 'patientId';
}
