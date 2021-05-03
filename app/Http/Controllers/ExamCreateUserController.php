<?php

namespace App\Http\Controllers;
use Log;
use DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\Difficulty;
use App\Models\Question;
use App\Models\Exam;
use App\Models\Userexam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class ExamCreateUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            
            // $exams = Exam::with('user')->get();
            $difficultyLevels = Difficulty::all();
            $questions = Question::with('exam')->get();
            // dd($questions);
            $page = $request->page;
            $enrolledExam = Userexam::where('user_id', auth()->user()->id)->get()->pluck('exam_id');
            // Log::info(gettype($enrolledExam->toArray()));
            // dd($enrolledExam);
            $examIids = $enrolledExam->toArray();
            /* foreach ($enrolledExam as $key => $value) {
                array_push($examIids, $value->exam_id);
            } */
            // dd($examIids);
            if ($page == 'exam-enrolled-user') {
                $exams = Exam::whereIn('id', $examIids)->get();
            }
            else
            {
                $exams = Exam::whereNotIn('id', $examIids)->get();
            }
            // dd($exams);
            return view('exam.index', compact(['exams','questions', 'page']));
            
        }
        catch(\Illuminate\Database\QueryException $e) {
            Log::info('Query: '.$e->getSql());
            Log::info('Query: Bindings: '.$e->getBindings());
            Log::info($e->getCode());
            Log::info($e->getMessage());
            $errorMessage = 'Internal Server Error. Please try again later.';
            return view('exam.index', compact('errorMessage'));
        }
        catch(\Exception $e) {
            Log::info($e->getCode());
            Log::info($e->getMessage());
            $errorMessage = 'Internal Server Error. Please try again later.';
            return view('exam.index', compact('errorMessage'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if ( Auth::user()->firstRole() == 'Company') {
            return view('exam.create');
        }
        else {
            //abort(404);
          return view('common.404');
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
        
        $messages = [
            'exam_name.required' => 'Please enter name of the exam',
            
            'Max_question.required' => 'Please enter name of the Max-questions',
            
            'Max_Marks.required' => 'Please enter name of the Max-Marks',
            
            'start_date.required' => 'Please enter the start_date',
            'start_date.date' => 'Please enter the correct date',
            'start_date.date_format' => 'Please enter the correct format of date',
            'start_date.before' => 'Please enter the date before ending date',


            'end_date.required' => 'Please enter the end-date',
            'end_date.date' => 'you have not enter the proper date',
            'end_date.date_format' => 'Please enter the date in correct format',
            'end_date.after' => 'Please enter the date after starting date',
        ];

        $validator = Validator::make($request->all(), [
            'exam_name' => 'bail|required',
            'Max_question' => 'bail|required',
            'Max_Marks' => 'bail|required',
            'start_date' => 'bail|required',
            'end_date' => 'bail|required',
        ], $messages);

        if($validator->fails()) {
            return redirect()->route('exam-user.create')
                            ->withErrors($validator)
                            ->withInput();
        }
        
        DB::beginTransaction();
        // dd($request->all());
        try {
            $ExamUser = new Exam();
            $ExamUser->name = $request->exam_name;
            $ExamUser->user_id = auth()->user()->id;
            $ExamUser->max_questions = $request->Max_question;
            $ExamUser->max_marks = $request->Max_Marks;
            $ExamUser->start_date_time =$request->start_date;
            $ExamUser->end_date_time = $request->end_date;
            

            $executeQuery = $ExamUser->save();
            DB::commit();
            if ($executeQuery) {
                $roleUser = new RoleUser;
                $roleUser->role_id = 2;
                $roleUser->user_id = $ExamUser->id;
                $executeQuery = $roleUser->save();

                if ($executeQuery) {
                    DB::commit();
                    Session::flash('success', 'Company user created successfully!');
                    return redirect()->route('exam-user.create');
                }
                else {
                    DB::rollback();
                    Session::flash('error', 'Internal Server Error! Please try again.');
                    return redirect()->route('exam-user.create')->withInput();
                }
            }
            else {
                DB::rollback();
                Session::flash('error', 'Internal Server Error! Please try again.');
                return redirect()->route('exam-user.create')->withInput();
            }
        }
        catch(\Illuminate\Database\QueryException $e) {
            Log::info($e->getCode());
            Log::info($e->getMessage());
            DB::rollback();
            Session::flash('error', 'Internal Server Error. Please try again later.');
            return redirect()->route('exam-user.create')->withInput();
        }
        catch(\Exception $e) {
            Log::info($e->getCode());
            Log::info($e->getMessage());
            DB::rollback();
            Session::flash('error', 'Internal Server Error. Please try again later.');
            return redirect()->route('exam-user.create')->withInput();
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
        //$exam = DB::table('exams')->where('id', $id)->first();
        $exam = Exam::find($id);
        // dump($date);
        $now = Carbon::now('Asia/Kolkata');
        $startDateObj = Carbon::createFromFormat('Y-m-d H:i:s', $exam->start_date_time, 'Asia/Kolkata');
        // dd($startDateObj);
        $diff = $startDateObj->diffInHours($now);
        if ($diff <= 1)
        {
            
            Session::flash('error', 'Can not be edited before one hour.');
            return redirect()->back();
        }
        else
        {
            $questions = $exam->questions;
            return view('exam.edit', compact('exam', 'questions'));
        }
        // $second = new Carbon('2021-03-26 15:00:00', 'Asia/Kolkata');
        // $carbon = $first->lessThan($second);
        // if($carbon){
            
        // }
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
        Log::info($request->exam_name);
        $exam = Exam::find($id);
        if (is_null($exam)) {
            Session::flash('error', 'Can not found any exam.');
            return redirect()->back();
        }
        else {
            // Validations
            // Update fields with try, catch and Database transactions

             $messages = [
            'exam_name.required' => 'Please enter name of the exam',
            
            'Max_question.required' => 'Please enter name of the Max-questions',
            
            'Max_Marks.required' => 'Please enter name of the Max-Marks',
            
            'start_date.required' => 'Please enter the start_date',
            'start_date.date' => 'Please enter the correct date',
            'start_date.date_format' => 'Please enter the correct format of date',
            'start_date.before' => 'Please enter the date before ending date',


            'end_date.required' => 'Please enter the end-date',
            'end_date.date' => 'you have not enter the proper date',
            'end_date.date_format' => 'Please enter the date in correct format',
            'end_date.after' => 'Please enter the date after starting date',
        ];

        $validator = Validator::make($request->all(), [
            'exam_name' => 'bail|required',
            'Max_question' => 'bail|required',
            'Max_Marks' => 'bail|required',
            'start_date' => 'bail|required',
            'end_date' => 'bail|required',
        ], $messages);

        if($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }
        
        DB::beginTransaction();
        // dd($request->all());
        try {
            $exam->name = $request->exam_name;
            $exam->user_id = auth()->user()->id;
            $exam->max_questions = $request->Max_question;
            $exam->max_marks = $request->Max_Marks;
            // $exam->start_date_time =$request->start_date;
            // $exam->end_date_time = $request->end_date;
            

            $executeQuery = $exam->save();
            if ($executeQuery) {
                $roleUser = new RoleUser;
                $roleUser->role_id = 2;
                $roleUser->user_id = $exam->id;
                $executeQuery = $roleUser->save();

                if ($executeQuery) {
                    DB::commit();
                    Session::flash('success', 'Exam Updated successfully!');
                    return redirect()->back();
                }
                else {
                    DB::rollback();
                    Session::flash('error', 'Internal Server Error! Please try again.');
                    return redirect()->back()->withInput();
                }
            }
            else {
                DB::rollback();
                Session::flash('error', 'Internal Server Error! Please try again.');
                return redirect()->back()->withInput();
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
            return view('exam.index');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function upcoming(Request $request)
    {
        // dd('upcoming');
        try {
            $questions = Question::with('exam')->get();
            $page = $request->page;
            $enrolledExam = Userexam::where('user_id', auth()->user()->id)->get()->pluck('exam_id');
            Log::info(gettype($enrolledExam->toArray()));
            $examIids = $enrolledExam->toArray();

            if ($page == 'exam-enrolled-user') {
                $exams = Exam::whereIn('id', $examIids)->where('start_date_time', '>', Carbon::now()->format('Y-m-d H:i:s'))->get();
                
                $now = Carbon::now('Asia/Kolkata');
                
            }
            return view('exam.index', compact(['exams','questions', 'page']));
            
        }
        catch(\Illuminate\Database\QueryException $e) {
            Log::info($e->getCode());
            Log::info($e->getMessage());
            $errorMessage = 'Internal Server Error. Please try again later.';
            return view('exam.index', compact('errorMessage'));
        }
        catch(\Exception $e) {
            Log::info($e->getCode());
            Log::info($e->getMessage());
            $errorMessage = 'Internal Server Error. Please try again later.';
            return view('exam.index', compact('errorMessage'));
        }
    }
    public function complete(Request $request)
    {
        // dd('upcoming');
        try {
            $questions = Question::with('exam')->get();
            $page = $request->page;
            $enrolledExam = Userexam::where('user_id', auth()->user()->id)->get()->pluck('exam_id');
            Log::info(gettype($enrolledExam->toArray()));
            $examIids = $enrolledExam->toArray();

            if ($page == 'exam-enrolled-user') {
                $exams = Exam::whereIn('id', $examIids)->where('end_date_time', '<', Carbon::now()->format('Y-m-d H:i:s'))->get();
                // dd($exams);
                // dd($exams->start_date_time);
                $now = Carbon::now('Asia/Kolkata');
                //dd($now);
                // $startDateObj = Carbon::createFromFormat('Y-m-d H:i:s', $exam->start_date_time, 'Asia/Kolkata');
                // dd($startDateObj);
            //     $upcomingExam = Userexam::where('$now', '<', '$date')->firstOr(function () {
            //       dd('inside')  ;
            // });
            }
            return view('exam.index', compact(['exams','questions', 'page']));
            
        }
        catch(\Illuminate\Database\QueryException $e) {
            Log::info($e->getCode());
            Log::info($e->getMessage());
            $errorMessage = 'Internal Server Error. Please try again later.';
            return view('exam.index', compact('errorMessage'));
        }
        catch(\Exception $e) {
            Log::info($e->getCode());
            Log::info($e->getMessage());
            $errorMessage = 'Internal Server Error. Please try again later.';
            return view('exam.index', compact('errorMessage'));
        }
    }

}
