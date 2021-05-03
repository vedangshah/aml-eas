<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    //many users can have many roles
    public function roles() {
        return $this->belongsToMany('App\Models\Role', 'role_users');
    }

    public function firstRole() {
        return $this->belongsToMany('App\Models\Role', 'role_users')->first()->name;
    }

    //one user can have many phone numbers
    public function phone() {
        return $this->hasOne('App\Models\Phone');
    }
    //any user can have many exams
    public function exams() {
        return $this->hasMany('App\Models\Exam');
    }
    //one user gives many exam
    public function uexam() {
        return $this->hasMany('App\Models\Userexam');
    }
    //one user can have many exam result.
    public function uer1() {
        return $this->hasMany('App\Models\Examresult');
    }
    public function ruser() {
        return $this->hasOne('App\Models\RoleUser');
    }
}
