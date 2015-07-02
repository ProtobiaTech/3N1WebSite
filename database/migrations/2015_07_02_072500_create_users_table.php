<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('email')->index();
            $table->string('phone')->nullable();
            $table->string('name')->nullable()->index();
            $table->string('password', 60);
            $table->string('remember_token')->nullable();
            $table->boolean('is_banned')->default(false)->index();
            $table->string('avatar')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        // 管理员用户
        App\User::create([
            'id'    =>  1,
            'email' =>  'admin@admin.local',
            'name'  =>  'admin',
            'password'  =>  bcrypt('admin'),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
