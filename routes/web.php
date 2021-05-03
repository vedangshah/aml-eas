<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['auth'])->group(function(){
    Route::resource('company-user', CompanyUserController::class);
    //->middleware('auth');
    Route::resource('jobseeker-user', JobseekerUserController::class)->except(['destroy']);
    Route::resource('forgot-user', ForgotpasswordUserController::class)->except(['destroy']);
    Route::resource('exam-user', ExamCreateUserController::class)->except(['destroy']);
    Route::resource('add-question', QuestionUserController::class)->except(['destroy']);
}); 
Route::resource('login', LoginUserController::class);

Route::get('/login1', function () {
    return view('welcome');
});

// All routes for JobSeeker with auth middleware
Route::group(['prefix' => 'jobseeker', 'middleware' => 'auth'], function() {
    Route::get('/enroll-user/{id}','JobseekerUserController@enrolled')->name('enroll-user');
    Route::get('/upexam','ExamCreateUserController@upcoming')->name('upexam');
    Route::get('/cexam','ExamCreateUserController@complete')->name('cexam');
});

Route::resource('signup', signupController::class)->except(['destroy']);

Route::prefix('jobseeker')->group(function() {
    Route::get('sign-up', function() {
        return view('jobseeker-registration.signup');
    });
    
    /* Route::get('candidate',function(){
        return view('jobseeker-registration.jobseeker');
    }); */
    // Route::post('sign-up', 'JobseekerUserController@signup')->name('signup');
});

//  Route::get('/logout', function () {
//      return view('login.login');
//  });
 Route::get('logout', 'LoginUserController@logout')->name('logout');

 Route::get('uexam', 'JobseekerUserController@exam')->name('uexam');

 Route::get('/error', function () {
    return view('common.404');
});


Route::get('/login8', function () {
    return view('login.login');
})->name('login');


Route::get('/com_registration', function () {
    return view('company_registration');
});

Route::get('/job_registration', function () {
    return view('jobseeker_registrtion');
});

Route::get('/forgotpassword', function () {
    return view('forgotpassword');
});

// Route::get('/view', function () {
//     return view('question-list.view');
// });


Route::get('/exam', function () {
    return view('exam');
});

Route::get('/question', function () {
    return view('Add_Quetion');
});

Route::get('/questionlist', function () {
    return view('questionlist');
});

Route::get('/exam', function () {
    return view('exam.exam');
});
/* Route::get('/modi', function () {
    return view('add-question.create');
});  */
Route::get('/com_reg', function () {
    return view('company-registration.company-registration');
});
Route::get('/forgotpassword', function () {
    return view('forgot-password.forgotpassword');
});

Route::get('/j-signup', function () {
    return view('jobseeker-registration.jobseeker-registration');
});

// Route::get('/view', function () {
//     return view('add-question.edit');
// });



Route::get('/user-role', 'user1@fetchRole');

// Route::view('login', 'login');

// Route::get('login','user1@home');

Route::get('check-role', 'user1@checkRole');

Route::get('/viewquestion', function () {
    return view('add-question.index1');
})->name('viewquestion');
