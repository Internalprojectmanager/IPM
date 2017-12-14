<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAssigneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assignee', function (Blueprint $table) {
            $table->dropColumn('project_id');
        });

        Schema::table('assignee', function (Blueprint $table) {
            $table->boolean('status')->nullable()->after('uuid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assignee', function (Blueprint $table) {
            $table->integer('project_id');
        });
    }
}
