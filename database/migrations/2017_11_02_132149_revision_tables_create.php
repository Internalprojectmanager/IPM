<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RevisionTablesCreate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feature_revision', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('feature_id');
            $table->uuid('release_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('status')->default('Open');
            $table->timestamp('deadline')->nullable();
            $table->string('creator_id');
            $table->timestamp('original_created_at')->nullable();
            $table->timestamps();
        });

        Schema::create('requirement_revision', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('requirement_id');
            $table->uuid('feature_id');
            $table->uuid('release_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('status')->default('Open');
            $table->timestamp('deadline')->nullable();
            $table->string('creator_id');
            $table->timestamp('original_created_at')->nullable();
            $table->timestamps();
        });

        Schema::create('release_revision', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('release_id');
            $table->string('name');
            $table->text('description');
            $table->double('version');
            $table->string('specification_type')->nullable();
            $table->timestamp('deadline')->nullable();
            $table->string('creator');
            $table->timestamp('original_created_at')->nullable();
            $table->timestamps();
        });

        Schema::create('letter_revision', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('letter_id');
            $table->string('project_id');
            $table->string('title');
            $table->text('content')->nullable();
            $table->text('contact_person')->nullable();
            $table->string('creator');
            $table->timestamp('original_created_at')->nullable();
            $table->timestamps();
        });

        Schema::create('document_revision', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('document_id');
            $table->string('project_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('creator');
            $table->timestamp('original_created_at')->nullable();
            $table->timestamps();
        });

        Schema::table('release', function (Blueprint $table) {
            $table->timestamp('deadline')->after('specificationtype');
            $table->dropColumn('revision_log');
        });

        Schema::table('feature', function (Blueprint $table) {
            $table->timestamp('deadline')->after('status');
            $table->dropColumn('revision_log');
        });

        Schema::table('requirement', function (Blueprint $table) {
            $table->timestamp('deadline')->after('status');
            $table->dropColumn('revision_log');
        });

        Schema::table('document', function (Blueprint $table) {
            $table->increments('id')->after('document_id');
        });

        Schema::table('letter', function (Blueprint $table) {
            $table->increments('id')->after('letter_id');
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
