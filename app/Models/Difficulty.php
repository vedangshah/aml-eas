<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Difficulty extends Model
{
   protected $table = 'difficulty_levels';
   // Fetch all questions for same difficulty
    public function ques()
    {
        return $this->hasMany('App\Models\Question', 'difficulty_levels_id');
    }
}
