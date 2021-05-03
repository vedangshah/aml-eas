<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Examresult extends Model
{
    protected $table = 'user_exam_result';
    //one exam result is belogs to  one user exam
    public function uex5() {
        return $this->belongsTo('App\Models\Userexam', 'user_exam_id');
    }
    
}
