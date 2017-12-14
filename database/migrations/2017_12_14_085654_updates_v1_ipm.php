<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatesV1Ipm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('release', function (Blueprint $table) {
            $table->integer('status')->nullable()->after('version');
            $table->integer('document_status')->nullable()->after('specificationtype');
            $table->text('extra_content')->nullable()->after('document_status');
        });

        Schema::table('feature', function (Blueprint $table) {
            $table->integer('category')->nullable()->after('status');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->integer('job_title')->nullable()->after('email');
            $table->boolean('active')->default(0)->after('job_title');
        });

        Schema::table('client', function (Blueprint $table) {
            $table->binary('contacts')->nullable()->after('contactemail');
            $table->binary('link')->nullable()->after('contacts');
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
