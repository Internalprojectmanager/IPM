<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

Use Carbon\Carbon;

class PlanTeam extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('plan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('users')->default(0);
            $table->integer('projects')->default(0);
            $table->integer('releases')->default(0);
            $table->integer('pdf')->default(0);
            $table->integer('documents')->default(0);
            $table->integer('support')->default(24);

        });

        Schema::create('team_plan', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('team_id');
            $table->unsignedInteger('plan_id');
            $table->timestamp('start');
            $table->timestamp('end')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('team_plan');
        Schema::drop('plan');

    }
}
