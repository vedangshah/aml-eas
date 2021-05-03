<?php

namespace App\Http\Controllers;
use Log;
use DB;
use App\Models\User;
use App\Models\Userexam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\Role;
use App\Models\RoleUser;

class JobseekerUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            Log::info(Auth::user()->roles()->first());
            $users = User::with(['roles' => function ($query) {
                $query->where('roles.name', '=', 'Jobseeker');
            }])->get(); 
            //dd($users);
            
            return view('jobseeker-registration.index', compact(['users']));
            
        }
        catch(\Illuminate\Database\QueryException $e) {
            Log::info($e->getCode());
            Log::info($e->getMessage());
            $errorMessage = 'Internal Server Error. Please try again later.';
            return view('jobseeker-registration.index', compact('errorMessage'));
        }
        catch(\Exception $e) {
            Log::info($e->getCode());
            Log::info($e->getMessage());
            $errorMessage = 'Internal Server Error. Please try again later.';
            return view('jobseeker-registration.index', compact('errorMessage'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role_id_for_jobseeker = Role::where('name', 'JobSeeker')->first()->id;
        return view('jobseeker-registration.signup', compact('role_id_for_jobseeker'));
       
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
            'jobseeker_name.required' => 'Please enter name of the Jobseeker',
            'jobseeker_name.max' => 'Jobseeker name should not be greater than 10 characters',
            'jobseeker_email.required' => 'Please enter email of the Jobseeker',
            'jobseeker_contact_no.required' => 'Please enter the mobile number',
            'jobseeker_contact_no.max' => 'mobile number should be 10 digit',
            'jobseeker_birth_date.required' => 'Please enter the birth date',
            'user_name.required' => 'Please enter the user name',
            'jobseeker_password.required' => 'Please enter the password',
            'jobseeker_password.min' => 'Password should be at least 8 digit',
            'jobseeker_address.required' => 'Please enter the address',
            // 'profile.required' => 'Please upload profile picture',


        ];

        $validator = Validator::make($request->all(), [
            'jobseeker_name' => 'bail|required|max:10',
            'jobseeker_email' => 'bail|required',
            'jobseeker_contact_no'=> 'bail|required|max:10',
            'jobseeker_birth_date'=> 'bail|required',
            'user_name'=> 'bail|required',
            'jobseeker_password'=> 'bail|required|min:8',
            'jobseeker_address'=> 'bail|required',
            // 'profile'=> 'bail|required'
        ], $messages);

        if($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }


        DB::beginTransaction();
        try {
            $jobseeker = new User();
            $jobseeker->name = $request->jobseeker_name;
            $jobseeker->email = $request->jobseeker_email;
            $jobseeker->contact_no = '1234567890';
            $jobseeker->date_of_birth = date('Y-m-d H:i:s');
            $jobseeker->company_name = $request->user_name;
            $jobseeker->password = $request->jobseeker_password;
            $jobseeker->address = $request->jobseeker_address;
            $jobseeker->profile_picture = 'temp';
            
            $executeQuery = $jobseeker->save();
            
            if ($executeQuery) {
                $roleUser = new RoleUser;
                $roleUser->role_id = 3;
                $roleUser->user_id = $jobseeker->id;
                $executeQuery = $roleUser->save();

                if ($executeQuery) {
                    DB::commit();
                    Session::flash('success', 'Company user created successfully!');
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
        //
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
        //
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
    public function exam(Request $request, $id)
    {
       //
    }
    
    public function enrolled($id) {
        Log::info("Enrolling user");
        Log::info($id);
        Log::info(auth()->user()->id);

        DB::beginTransaction();
        try
        {
            
            $examuser = new Userexam;
            $examuser->user_id =auth()->user()->id;
            $examuser->exam_id = $id;
            // dd($examuser);
            $execute = $examuser->save();
           

            if ($execute) {
                DB::commit();
                Session::flash('success', 'Company user created successfully!');
                return redirect()->back();
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
        return redirect()->back();
    }

   
}
