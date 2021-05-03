<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table = 'exams';
// each exam is belongs to specific user
    public function user() {
        return $this->belongsTo('App\Models\User');
    }
    // one exam has many questions
    public function questions(){
        return $this->hasMany('App\Models\Question');
    }
    //many user exam can be having in one exam
    public function uexam2(){
        return $this->hasMany('App\Models\Userexam', 'exam_id');
    }
    //one exam has one exam result
    public function uer2() {
        return $this->belongsTo('App\Models\Examresult');
    }
}
