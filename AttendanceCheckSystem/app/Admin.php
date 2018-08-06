<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $primaryKey = 'username';
    public $incrementing = false;
    public $timestamps = false;
    protected $guard = 'admin';
    protected $fillable = [
        'username', 'password'
    ];
    protected $hidden = [
        'password',
    ];
}
