<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RoleAssignee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_assignee', function (Blueprint $table) {
            $table->increments('id');
            $table->string('assignee_id');
            $table->integer('role_id')->default(0);
            $table->timestamps();
        });

        Schema::table('roles', function (Blueprint $table) {
           $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('role_assignee');

        Schema::create('roles', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
}
