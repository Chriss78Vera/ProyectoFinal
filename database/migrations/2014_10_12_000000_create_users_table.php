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
           // ID para la tabla de la BDD
                    $table->id();
                    // columnas para la tabla BDD
                    $table->string('first_name', 50);
                    $table->string('last_name', 50);
                    $table->string('username', 50);
                    $table->string('personal_phone', 10);
                    $table->string('home_phone', 9);
                    $table->string('address', 50);
                    $table->string('password');
                    $table->boolean('state')->default(true);
                    
                    $table->string('email')->unique();
                    
                    $table->date('birthdate')->nullable();
                    $table->timestamp('email_verified_at')->nullable();

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
