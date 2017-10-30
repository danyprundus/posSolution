<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('permissions', function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->string('uuid', 36)->primary()->unique();
            $table->string('name');
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('permission_role', function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->string('role_id', 36);
            $table->string('permission_id', 36);
            $table->foreign('role_id')->references('uuid')->on('roles')->onDelete('cascade');
            $table->foreign('permission_id')->references('uuid')->on('permissions')->onDelete('cascade');
            $table->primary(['role_id', 'permission_id']);
        });

        Schema::create('role_user', function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->string('user_id', 36);
            $table->string('role_id', 36);
            $table->foreign('role_id')->references('uuid')->on('roles')->onDelete('cascade');
            $table->foreign('user_id')->references('uuid')->on('users')->onDelete('cascade');
            $table->primary(['role_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::drop('permissions');
        Schema::drop('permission_role');
        Schema::drop('role_user');
    }
}
