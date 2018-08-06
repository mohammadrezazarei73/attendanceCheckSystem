<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public $timestamps = false;
    public function classes()
    {
        return $this->belongsToMany('App\ClassModel');
    }
    public function attendances(){
        return $this->hasMany('App\Attendance');
    }
}
