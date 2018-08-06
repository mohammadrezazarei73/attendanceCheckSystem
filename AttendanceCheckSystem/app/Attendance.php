<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    public $timestamps = false;
    public function session(){
        return $this->belongsTo('App\Session');
    }
    public function student(){
        return $this->belongsTo('App\Student');
    }
}
