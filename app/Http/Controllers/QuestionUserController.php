<?php

namespace App\Http\Controllers;
use Log;
use DB;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Options;
use App\Models\Difficulty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class QuestionUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams = Exam::all();
        $difficultyLevels = Difficulty::all();
        $exam1 = Exam::with('questions')->get();
        $questions = Question::with('option')->get();
        // dd($difficultyLevels);
        return view('add-question.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $exams = Exam::all();
            $difficultyLevels = Difficulty::all();
            return view('add-question.create', compact(['exams', 'difficultyLevels']));
        }
        catch(\Illuminate\Database\QueryException $e) {
            Log::info($e->getCode());
            Log::info($e->getMessage());
            $errorMessage = 'Internal Server Error. Please try again later.';
            return view('add-question.create', compact('errorMessage'));
        }
        catch(\Exception $e) {
            Log::info($e->getCode());
            Log::info($e->getMessage());
            $errorMessage = 'Internal Server Error. Please try again later.';
            return view('add-question.create', compact('errorMessage'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //if (auth()->check())
        // if (auth()->check()->role_id == 2)
        // dd($request->all());
        $messages = [
            'question.required' => 'Please enter the question',
            'option_one.required' => 'Please enter the option',
            'option_two.required' => 'Please enter the option',
            'option_three.required' => 'Please enter the option',
            'option_four.required' => 'Please enter the option',
            'correct_answer.required' => 'Please enter the currect answer',
            'diff_level.required' => 'Please enter the difficulty level',
            
        ];

        $validator = Validator::make($request->all(), [
            
            'question' => 'bail|required',
            'option_one' => 'bail|required',
            'option_two' => 'bail|required',
            'option_three' => 'bail|required',
            'option_four' => 'bail|required',
            'correct_answer' => 'bail|required',
            'diff_level' => 'bail|required',
            
        ], $messages);

        if($validator->fails()) {
            dd($validator);
            Log::info('inside error');
            return redirect()->route('add-question.create')
                            ->withErrors($validator)
                            ->withInput();
        }
        
        DB::beginTransaction();

        try {
            Log::info('inside try');
            $question = new Question();
            $question->exam_id = $request->exam_id;
            $question->description = $request->question;
            $question->difficulty_levels_id = $request->diff_level;

            $executeQuery = $question->save();

            if ($executeQuery) {
                
                $options = new Options;
                $options->question_id = $question->id;
                $options->option_description = $request->option_one;
                $options->is_correct =  ($request->correct_answer == $request->option_one ? 1 : 0);
                $executeQuery = $options->save(); 
                if (! $executeQuery) {
                    DB::rollback();
                    Session::flash('error', 'Internal Server Error! Please try again.');
                    return redirect()->route('add-question.create')->withInput();
                }
                $options = new Options;
                $options->question_id = $question->id;
                $options->option_description = $request->option_two;
                $options->is_correct =  ($request->correct_answer == $request->option_two ? 1 : 0);
                $executeQuery = $options->save(); 
                if (! $executeQuery) {
                    DB::rollback();
                    Session::flash('error', 'Internal Server Error! Please try again.');
                    return redirect()->route('add-question.create')->withInput();
                }
                $options = new Options;
                $options->question_id = $question->id;
                $options->option_description = $request->option_three;
                $options->is_correct =  ($request->correct_answer == $request->option_three ? 1 : 0);
                $executeQuery = $options->save(); 
                if (! $executeQuery) {
                    DB::rollback();
                    Session::flash('error', 'Internal Server Error! Please try again.');
                    return redirect()->route('add-question.create')->withInput();
                }
                $options = new Options;
                $options->question_id = $question->id;
                $options->option_description = $request->option_four;
                $options->is_correct =  ($request->correct_answer == $request->option_four ? 1 : 0);
                $executeQuery = $options->save(); 

                if ($executeQuery) {

                    DB::commit();
                    Session::flash('success', 'Company user created successfully!');
                    return redirect()->route('add-question.create');
                }
                else {
                    DB::rollback();
                    Session::flash('error', 'Internal Server Error! Please try again.');
                    return redirect()->route('add-question.create')->withInput();
                }
            }
            else {
                DB::rollback();
                Session::flash('error', 'Internal Server Error! Please try again.');
                return redirect()->route('add-question.create')->withInput();
            }
        }
        catch(\Illuminate\Database\QueryException $e) {
            Log::info($e->getCode());
            Log::info($e->getMessage());
            DB::rollback();
            Session::flash('error', 'Internal Server Error. Please try again later.');
            return redirect()->route('add-question.create')->withInput();
        }
        catch(\Exception $e) {
            Log::info($e->getCode());
            Log::info($e->getMessage());
            DB::rollback();
            Session::flash('error', 'Internal Server Error. Please try again later.');
            return redirect()->route('add-question.create')->withInput();
        }
    }
    
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $exams = Exam::all();
        $difficultyLevels = Difficulty::all();
        // $exam1 = Exam::with('questions')->get();
        $question = Question::where('id', $id)->first();
        return view('add-question.edit', compact(['exams','difficultyLevels','question']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Log::info("Inside update");
        Log::info($id);
        // $options = Options::where('question_id', $id)->get();
        $question = Question::where('id', $id)->first();
        
        DB::beginTransaction();
        try{
            
                $question->description = $request->question;
                $question->difficulty_levels_id = $request->diff_level;
                $executeQuery = $question->save();
               
                if($executeQuery){
                    /* dd($request->options);
                    dd($question->option->toArray()); */
                    Log::info($request->correct_answer);
                    array_map(function($optOriginal, $optFromRequest) use ($request, $id) {
                        Log::info($optFromRequest);
                        $option = Options::where('id', $optOriginal['id'])->where('question_id', $id)->first();
                        $option->option_description = $optFromRequest;
                        $option->is_correct =  ($request->correct_answer == $optFromRequest ? 1 : 0);
                        $executeQuery = $option->save();
                    }, $question->option->toArray(), $request->options);

                    if ($executeQuery) {

                        DB::commit();
                        Session::flash('success', 'Company user created successfully!');
                        return redirect()->route('add-question.index');
                    }
                    else {
                        DB::rollback();
                        Session::flash('error', 'Internal Server Error! Please try again.');
                        return redirect()->back()->withInput();
                    }
                }
        }
        catch(\Illuminate\Database\QueryException $e) {
            Log::info($e->getCode());
            Log::info($e->getMessage());
            DB::rollback();
            Session::flash('error', 'Internal Server Error. Please try again later.');
            return redirect()->back()->withInput();
        }
        catch(\Exception $e) {
            Log::info($e->getCode());
            Log::info($e->getMessage());
            DB::rollback();
            Session::flash('error', 'Internal Server Error. Please try again later.');
            return redirect()->back()->withInput();
        }

       
       /*  $exams = Exam::all();
        $difficultyLevels = Difficulty::all();
        return view('add-question.edit', compact(['exams','difficultyLevels'])); */
        // $question = Question::find($id);
        // if (is_null($question)) {
            Session::flash('error', 'Can not found any exam.');
            return redirect()->back();
        // }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
