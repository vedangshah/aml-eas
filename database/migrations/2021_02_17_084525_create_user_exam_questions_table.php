<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserExamQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_exam_questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->unsignedBigInteger('user_exam_id');  
            $table->unsignedBigInteger('question_id');           
            $table->unsignedBigInteger('option_id');

            
            
            $table->foreign('user_exam_id')->references('id')->on('user_exam');
            $table->foreign('question_id')->references('id')->on('questions');
            $table->foreign('option_id')->references('id')->on('options');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_exam_questions');
    }
}
