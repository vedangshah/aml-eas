<?php

use Illuminate\Database\Seeder;

class Difficulty_LevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('difficulty_levels')->insert([
            ['level_name' => 'easy','weighted' => '10'],
            ['level_name' => 'medium','weighted' => '20'],
            ['level_name' => 'hard','weighted' => '30']
        ]);
    }
}
