<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {        
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(Difficulty_LevelTableSeeder :: class);
        $this->call(ExamTableSeeder :: class);
        $this->call(QuestionTableSeeder :: class);
    }
}
