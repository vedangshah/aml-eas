<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Options extends Model
{
    protected $table = 'options';
    //many options can be belong with one question
    public function question()
    {
        return $this->belongsTo('App\Models\Question');
    }
    
    
}
