<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable
{
    protected $primaryKey = 'username';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'username', 'password','first_name','last_name'
    ];
    protected $hidden = [
        'password',
    ];
    public function classes(){
        return $this->hasMany('App\ClassModel','teacher_id','username');
    }
}
