<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
            $table->string('uuid', 36)->primary()->unique();
			$table->string('name');
			$table->string('email')->unique();
			$table->string('phone')->nullable();
			$table->string('username')->unique();
			$table->string('password', 60);
            $table->string('photo')->nullable();
			$table->string('role_id', 36);
			$table->rememberToken();
			$table->foreign('role_id')->references('uuid')->on('roles')->onDelete('cascade')->onUpdate('cascade');
			$table->timestamps();
            $table->string('api_token', 60)->unique();
		});
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
