<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserExamResultTable extends Migration
{
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_exam_result', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_exam_id');
            $table->integer('total_correct_answers');
            $table->integer('score');
            
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            
            $table->foreign('user_exam_id')->references('id')->on('user_exam');
          
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_exam_result');
    }
}
