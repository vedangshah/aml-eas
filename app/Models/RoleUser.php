<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    public function user() {
        return $this->belongsTo('App\Models\User','user_id');
    }
    
    public function role() {
        return $this->hasone('App\Models\Role');
    }
}
