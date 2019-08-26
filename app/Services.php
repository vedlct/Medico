<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    public $timestamps = false;
    protected $table = 'services';
    protected $primaryKey = 'servicesId';

    public static function findOrFail($id)
    {
    }
}
