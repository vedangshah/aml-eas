<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserExamQuestion extends Model
{
    public $timestamps = false;
    protected $table = 'user_exam_questions';

    // Fetch all questions for each user for a specific exam
    public function uexam6() {
        return $this->belongsTo('App\Models\Userexam','user_exam_id');
    }
}
