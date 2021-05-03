<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    //one phone number can belong to one user
    public function user() {
        return $this->belongsTo('App/Models/User');
    }
}
