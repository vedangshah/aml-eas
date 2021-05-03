<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class LoginUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('login.login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::info($request->email);
        Log::info($request->password);
        $messages = [
            
            'username.required' => 'Please enter the username',
            'password.required' => 'Please enter the username',
            
        ];

        $validator = Validator::make($request->all(), [
            'email' => 'bail|required',
            'password' => 'bail|required'
        ], $messages);

        if($validator->fails()) {
            Log::info("Failed");
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }
        else {
            Log::info("Passed");
            $credentials = $request->only('email', 'password');
            Log::info($credentials);
            if (Auth::attempt($credentials)) {
               Log::info(Auth::user()->roles()->get());
            //   Log::info(auth()->user()->roles()->get());
            //   Log::info(User::find(1)->roles()->get());
                Log::info("Authenticated");
                Log::info(Auth::user());
                Log::info(Auth::user()->firstRole());
                if(Auth::user()->firstRole() == 'Admin'){
                return redirect()->route('company-user.create');
                }
                elseif (Auth::user()->firstRole() == 'Company') {
                    return redirect()->route('exam-user.create');
                }
                elseif (Auth::user()->firstRole() == 'JobSeeker') {
                    return view('jobseeker-registration.jobseeker');
                }
               
            }
            else {
                Log::info("Not Authenticated");
                // Add custom error key-value in validator object
                $validator->errors()->add('login-failed', 'The entered credentials do not match our records. Please try again.');
                return redirect()->route('login.create')
                            ->withErrors($validator)
                            ->withInput();
            }
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
        
    }
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('login'); 
    }
}
