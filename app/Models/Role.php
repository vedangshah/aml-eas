<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //many roles can associate many users
    public function users() {
        return $this->belongsToMany('App\Models\User', 'role_users');
    }
    public function ruser() {
        return $this->belongsTo('App\Models\User', 'role_id');
    }
}
