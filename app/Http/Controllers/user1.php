<?php

namespace App\Http\Controllers;

use Log;
use App\Models\User;
use App\Models\Exam;
use App\Models\Role;
use App\Models\Question;
use App\Models\Options;
use App\Models\Difficulty;
use App\Models\Userexam;
use App\Models\UserExamQuestion;
use App\Models\Examresult;
use App\Models\RoleUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class user1 extends Controller
{
    function home()
    {
        $collection = collect([1, 2, 4, 12, 34, 90, 99]);
        Log::info('First: '.$collection->first());
        Log::info('Last: '.$collection->last());
        Log::info($collection->all());

        
        $collection = collect([
            ['name'=>'hemant','age'=>'20'],
            ['name'=>'prem', 'age'=>'20'],
        ]);
        
        Log::info($collection->sortBy('name')->all());
        
        Log::info($collection->sortByDesc('name')->all());
        
        Log::info($collection->where('name','hemant')->all());

        Log::info($collection->whereBetween('age',[19,21])->all());
        
        Log::info($collection->whereNotNull('age')->all());
        
    }

    function fetchRole() {
        $user = User::find(1);
        
        // Log::info($user);
         
         $exam = User::find(1)->exams;
        //Log::info($exam);
        $user = Exam::find(1)->user;
         //Log::info($user);
         $role = User::find(1)->roles;
        // Log::info($role);
        
        $role = Role::find(1)->users;
        //Log::info($role);

        $questions = Exam::find(1)->questions;
       //Log::info($questions);

          $exam = Question::find(1)->exam;
        // Log::info($exam);

        
        $Question1 = Question::find(1)->option;
      //Log::info($Question1);

        
        $option1 = Options::find(1)->question;
       // Log::info($option1);
         //return $role;
         $diff2 = Question::find(1)->diff;
       //  Log::info($diff2);
         
      $diff1 = Difficulty::find(2)->ques;
     // Log::info($diff1);

     /* $uexam1 = User::find(1)->uexam;
      Log::info($uexam1);
      foreach($uexam1 AS $uexam) {
        //Log::info($uexam);
        //Log::info($uexam->uexam2);
        
      }
      
      

       $uexam5 = Userexam::find(1)->user1;
     //   Log::info($uexam5);
     $uexam8 = User::find(1)->uexam;
     //Log::info($uexam8);
       
     
    //$uexam4 = Exam::find(1)->uexam2;
    //Log::info($uexam4);
     
     
       
      /*$uexam7 = User::find(1)->uexam;
      Log::info($uexam7);
     
      foreach($uexam7 as $uexam)
      {
        Log::info("Inside loop");
        Log::info($uexam);
        
      // Log::info($uexam->ueq);
       Log::info($uexam->exam2);
      }  
     /*
      $uexam10 = UserExamQuestion::find(1)->uexam6;
      dd($uexam10);*/
     // $ur1 = Userexam::find(1)->uer1;
      //Log::info($ur1);

      
      $ur1 = Examresult::find(1)->uex5;
      //Log::info($ur1);
     

    }

    function checkRole() {;
      // Eager loading
      // $users = User::with('roles')->get();
      

      /* $users = User::with(['roles' => function ($query) {
        $query->where('roles.name', '=', 'Company');
      }])->get(); */

      /*$users = User::all();
      foreach($users as $user) {
        if (sizeof($user->roles()->get()) > 0) {
          if ($user->roles()->first()->name == 'Company') {
            // Create exam and attach user_id from $user variable
          }
        }
      }
      //$roles = Role::where('name', 'Company')->first()->id;
      //dd($users);

      $exam = Exam::all();
      //dd($exam);*/

      $diffi=Difficulty::all();
     // dd( $diffi);

      
       //dd(Exam::with('questions')->get());
      //  dd(Question::with('option')->get());
      // dd(Options::with('question')->first());
      $collectionA = collect([1,2,3,4,5,6]);
    $collectionB = collect([3, 4, 6]);
  
    $collection = $collectionA->diff($collectionB);
    // Exam::where('')
    // dd($collection);
  
    }
}

