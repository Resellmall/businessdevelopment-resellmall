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
            $table->id();
            $table->string('name',70);            
            $table->string('mobile',15);
            $table->string('email')->unique();                
            $table->string('password');            
            $table->tinyInteger('gender')->nullable();
            $table->string('image')->nullable();
            $table->smallInteger('role_id');
            $table->smallInteger('otp')->nullable();
            $table->date('dob')->nullable();
            $table->string('referal_code', 10)->nullable();
            $table->tinyInteger('user_status')->nullable();
            $table->string('deactive_reason')->nullable();
            $table->rememberToken();
            $table->timestamps();
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
