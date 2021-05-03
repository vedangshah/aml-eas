<?php
use App\Models\Question;

use App\Models\Difficulty;
use App\Models\Exam;
use App\Models\User;
use Illuminate\Database\Seeder;

class QuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exams = Exam::all();
        $diffculty_levels_id1=Difficulty::all();
        foreach($exams as $exam) {
            foreach($diffculty_levels_id1 as $diff_level)
            {
                  factory(App\Models\Question::class,1)->create([
                        'exam_id' => $exam->id ,
                        'difficulty_levels_id'=>$diff_level->id,
                       
                  ]);
            }

            
        }
        
    }
}
