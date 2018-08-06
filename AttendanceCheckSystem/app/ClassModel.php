<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    public $timestamps = false;
    protected $table = 'classes';

    public function teacher(){
		return $this->belongsTo('App\Teacher','teacher_id','username');
    }
    public function students()
    {
        return $this->belongsToMany('App\Student');
    }
    public function sessions(){
        return $this->hasMany('App\Session','class_id','id');
    }

}
