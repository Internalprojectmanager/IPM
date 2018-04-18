<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateIdProjectCompany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client', function (Blueprint $table) {
            $table->dropPrimary('id');
            $table->dropColumn('id');
        });

        Schema::table('client', function (Blueprint $table) {
            $table->increments('id')->first();
        });

        Schema::table('project', function (Blueprint $table) {
            $table->dropPrimary('id');
            $table->dropColumn('id');
            $table->dropColumn('company_id');
        });

        Schema::table('project', function (Blueprint $table) {
            $table->increments('id')->first();
            $table->integer('company_id')->after('id');
        });

        Schema::table('release', function (Blueprint $table) {
            $table->dropColumn('project_id');
        });

        Schema::table('release', function (Blueprint $table) {
            $table->integer('project_id')->after('id');
        });

        Schema::table('document', function (Blueprint $table) {
            $table->dropColumn('project_id');
        });

        Schema::table('document', function (Blueprint $table) {
            $table->integer('project_id')->after('id');
        });

        Schema::table('document', function (Blueprint $table) {
            $table->dropColumn('project_id');
        });

        Schema::table('document', function (Blueprint $table) {
            $table->integer('project_id')->after('id');
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
