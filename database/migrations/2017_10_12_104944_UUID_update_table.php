<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UUIDUpdateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('release', function (Blueprint $table) {
            $table->string('id',50)->change();
            $table->text('description')->nullable()->change();
        });

        Schema::table('feature', function (Blueprint $table) {
            $table->increments('id')->change();
            $table->string('release_id',50)->change();
            $table->text('description')->nullable()->change();
        });

        Schema::table('requirement', function (Blueprint $table) {
            $table->increments('id')->change();
            $table->integer('feature_id')->change();
            $table->string('release_id',50)->change();
            $table->text('description')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
