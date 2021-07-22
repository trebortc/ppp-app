<?php

use App\User;
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
            $table->string('name');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->enum('sex', ['male', 'female'])->nullable();
            $table->rememberToken();
            $table->string('userable_type');
            $table->string('userable_id');
            $table->string('status');
            $table->enum('role', [
                User::ROLE_STUDENT,
                User::ROLE_TEACHER,
                User::ROLE_REPRESENTATIVE,
                User::ROLE_ADMINISTRATIVE,
                User::ROLE_COMMISSION,
                User::ROLE_SUPERADMIN
            ]);
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
