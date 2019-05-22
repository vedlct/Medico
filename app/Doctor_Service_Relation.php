<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor_Service_Relation extends Model
{
    public $timestamps = false;
    protected $table = 'doctor_service_relation';
    protected $primaryKey = 'doctor_service_relation';
}
