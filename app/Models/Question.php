<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';
    
    //many questions can belong to one exam
    public function exam(){
        return $this->belongsTo('App\Models\Exam');
    }
    //one question can have many options
    public function option()
    {
        return $this->hasMany('App\Models\Options');
    }
    //any question can have single difficulty level
    public function diff()
    {
        return $this->belongsTo('App\Models\Difficulty', 'difficulty_levels_id');
    }
   
    
    
}
