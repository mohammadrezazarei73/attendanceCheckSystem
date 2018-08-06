<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    public $timestamps = false;
    public function class(){
        return $this->belongsTo('App\ClassModel','class_id','id');
    }
    public function attendances(){
        return $this->hasMany('App\Attendance');
    }
}
