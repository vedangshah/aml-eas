<?php

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::where('name','admin')->first()->id;
        factory(App\Models\User::class, 3)->create()->each(function($user) use ($role) {
    $user->roles()->attach($role);
        });
        
        $role = Role::where('name','Company')->first()->id;
        factory(App\Models\User::class, 2)->create()->each(function($user) use ($role) {
        $user->roles()->attach($role);
        });

       
    }
}
