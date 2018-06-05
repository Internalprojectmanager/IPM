<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('letter_revision');

        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('team_user', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('team_id');
            $table->unsignedInteger('roleid');
            $table->boolean('current');
        });

        Schema::create('roles', function (Blueprint $table){
           $table->increments('id');
           $table->string('name');
        });

        Schema::table('client', function (Blueprint $table){
            $table->unsignedInteger('team_id')->nullable()->after('id');
        });

        Schema::table('project', function (Blueprint $table){
            $table->unsignedInteger('team_id')->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('roles');
        Schema::drop('teams_users');
        Schema::drop('teams');

        Schema::create('letter_revision', function (Blueprint $table){});
    }
}
