<?php

use Illuminate\Database\Seeder;
use App\Models\Question;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = Question::get();

        $options = [];
        foreach ($questions as $question)
        {
            $option = [];
            for ($i=1; $i < 5; $i++)
            {
                $option[$i]['question_id'] = $question->id;
                $option[$i]['option_description'] = 'Option '.$i;
                $option[$i]['is_correct'] = 0;
            }
            $option[rand(1, 4)]['is_correct'] = 1;
            // array_push($options, $option);
            DB::table('options')->insert(
                $option
            );
        }

    }
}
