<?php

use Illuminate\Database\Seeder;
use App\Models\Exam;

use App\Models\User;
use App\Models\Role;

class ExamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $users = User::all();
      foreach($users as $user) {
        if (sizeof($user->roles()->get()) > 0) {
          if ($user->roles()->first()->name == 'Company') {
            // Create exam and attach user_id from $user variable

            factory(App\Models\Exam::class, 1)->create([
                'user_id' => $user->id
            ]);
          }
        }
      }        
    }
}
