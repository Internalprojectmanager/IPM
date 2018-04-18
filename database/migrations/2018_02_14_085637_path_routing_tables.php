<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PathRoutingTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project', function (Blueprint $table) {
            $table->string('path')->after('name');
        });

        Schema::table('client', function (Blueprint $table) {
            $table->string('path')->after('name');
        });

        Schema::table('release', function (Blueprint $table) {
            $table->string('path')->after('name');
        });

        Schema::table('feature', function (Blueprint $table) {
            $table->string('path')->after('name');
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
