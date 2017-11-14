<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RevisionsIPMDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('requirement', function (Blueprint $table) {
            $table->uuid('requirement_uuid')->after('id');
            $table->uuid('feature_uuid')->after('requirement_uuid')->nullable();
            $table->dropColumn('feature_id');
            $table->timestamp('revision_log')->after('updated_at')->nullable();
        });

        Schema::table('release', function (Blueprint $table) {
            $table->dropPrimary('id');
            $table->uuid('release_uuid')->after('id');
            $table->dropColumn('id');
            $table->timestamp('revision_log')->after('updated_at')->nullable();
        });

        Schema::table('document', function (Blueprint $table) {
            $table->dropPrimary('id');
            $table->uuid('document_id')->after('id');
            $table->dropColumn('id');
        });

        Schema::table('letter', function (Blueprint $table) {
            $table->dropPrimary('id');
            $table->uuid('letter_id')->after('id');
            $table->dropColumn('id');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('requirement', function (Blueprint $table) {
            $table->dropColumn(['feature_uuid', 'requirement_uuid', 'revision_log']);
            $table->string('feature_id', 50)->index()->after('id');
        });

        Schema::table('release', function (Blueprint $table) {
            $table->dropPrimary('id');
            $table->primary('release_uuid');
            $table->dropColumn('id');
            $table->string('id',50)->index();
            $table->primary('id');
            $table->dropColumn(['release_uuid', 'revision_log']);
        });
    }

}
