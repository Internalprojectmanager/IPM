<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatedStatusProject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('type', 100)->nullable();
            $table->string('color', 7)->nullable();
        });

        Schema::create('assignee', function (Blueprint $table) {
            $table->integer('userid');
            $table->integer('project_id')->nullable();
            $table->uuid('uuid')->nullable();
        });

        Schema::table('project', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('client', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('project', function (Blueprint $table) {
            $table->integer('status')->after('description');
        });

        Schema::table('client', function (Blueprint $table) {
            $table->integer('status')->after('description');
        });




    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
