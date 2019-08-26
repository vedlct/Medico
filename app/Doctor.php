<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Doctor extends Model
{
    public $timestamps = false;
    protected $table = 'doctor';
    protected $primaryKey = 'doctorId';
}
