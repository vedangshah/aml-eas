<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->date('date_of_birth')->nullable();
            $table->string('password');
            $table->string('address');
            $table->string('contact_no');
            $table->string('company_name');
            $table->string('profile_picture');
           // $table->timestamp('email_verified_at')->nullable();
            //$table->boolean('is_active')->default(1);
           // $table->rememberToken();
           $table->timestamp('created_at')->useCurrent();
           $table->timestamp('updated_at')->useCurrent();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
