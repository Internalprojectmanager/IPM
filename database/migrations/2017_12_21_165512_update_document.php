<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDocument extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('document', function (Blueprint $table) {
            $table->string('filename')->nullable()->after('description');
            $table->string('link')->nullable()->after('description');
            $table->integer('status')->nullable()->after('link');
            $table->uuid('release_id')->nullable()->after('project_id');
            $table->integer('category')->nullable()->after('link');
            $table->text('description')->nullable()->change();
        });

        Schema::table('document_revision', function (Blueprint $table) {
            $table->string('filename')->nullable()->after('description');
            $table->string('link')->nullable()->after('description');
            $table->integer('status')->nullable()->after('link');
            $table->uuid('release_id')->nullable()->after('project_id');
            $table->integer('category')->nullable()->after('link');
            $table->text('description')->nullable()->change();
        });

        Schema::drop('testreport');
        Schema::drop('letter');

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
