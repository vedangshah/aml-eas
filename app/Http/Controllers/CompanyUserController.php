<?php

namespace App\Http\Controllers;

use Log;
use DB;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class CompanyUserController extends Controller
{
    public function _construct() {
        $this->middleware('auth');
    }
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
                $query->where('roles.name', '=', 'Company');
            }])->get(); 
            //dd($users);
            
            return view('company-registration.index', compact(['users']));
            
        }
        catch(\Illuminate\Database\QueryException $e) {
            Log::info($e->getCode());
            Log::info($e->getMessage());
            $errorMessage = 'Internal Server Error. Please try again later.';
            return view('company-registration.index', compact('errorMessage'));
        }
        catch(\Exception $e) {
            Log::info($e->getCode());
            Log::info($e->getMessage());
            $errorMessage = 'Internal Server Error. Please try again later.';
            return view('company-registration.index', compact('errorMessage'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if ( Auth::user()->firstRole() == 'Admin') {
            return view('company-registration.create');
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
            'company_name.required' => 'Please enter name of the company',
            'company_name.max' => 'Company name should not be greater than 10 characters',
            'company_user_name.required' => 'Please enter name of the user',
            
            'company_user_name.max' => 'Company user name should not be greater than 10 characters',
            
            'company_email.required' => 'Please enter email of the company',
            'company_password.required' => 'Please enter the password',
            'company_password.min' => 'password should be 8 digit long',
            'company_address.required' => 'Please enter address of the company',
        ];

        $validator = Validator::make($request->all(), [
            'company_name' => 'bail|required|max:10',
            'company_user_name' => 'bail|required|max:10',
            'company_email'=>'bail|required',
            'company_password'=>'bail|required|min:8',
            'company_address'=>'bail|required'
        ], $messages);

        if($validator->fails()) {
            dd($validator);
            return redirect()->route('company-user.create')
                            ->withErrors($validator)
                            ->withInput();
        }
        
        DB::beginTransaction();

        try {
            $companyUser = new User();
            $companyUser->name = $request->company_user_name;
            $companyUser->email = $request->company_email;
            $companyUser->date_of_birth = date('Y-m-d H:i:s');
            $companyUser->password = $request->company_password;
            $companyUser->address = $request->company_address;
            $companyUser->contact_no = '1234567890';
            $companyUser->company_name = $request->company_name;
            $companyUser->profile_picture = $request->company_name;

            $executeQuery = $companyUser->save();

            if ($executeQuery) {
                $roleUser = new RoleUser;
                $roleUser->role_id = 2;
                $roleUser->user_id = $companyUser->id;
                $executeQuery = $roleUser->save();

                if ($executeQuery) {
                    DB::commit();
                    Session::flash('success', 'Company user created successfully!');
                    return redirect()->route('company-user.create');
                }
                else {
                    DB::rollback();
                    Session::flash('error', 'Internal Server Error! Please try again.');
                    return redirect()->route('company-user.create')->withInput();
                }
            }
            else {
                DB::rollback();
                Session::flash('error', 'Internal Server Error! Please try again.');
                return redirect()->route('company-user.create')->withInput();
            }
        }
        catch(\Illuminate\Database\QueryException $e) {
            Log::info($e->getCode());
            Log::info($e->getMessage());
            DB::rollback();
            Session::flash('error', 'Internal Server Error. Please try again later.');
            return redirect()->route('company-user.create')->withInput();
        }
        catch(\Exception $e) {
            Log::info($e->getCode());
            Log::info($e->getMessage());
            DB::rollback();
            Session::flash('error', 'Internal Server Error. Please try again later.');
            return redirect()->route('company-user.create')->withInput();
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
        $user = User::find($id);
        return view('company-registration.edit', compact(['user']));
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
        Post::destroy($id);
        return redirect()->route('login'); 
    }
}
