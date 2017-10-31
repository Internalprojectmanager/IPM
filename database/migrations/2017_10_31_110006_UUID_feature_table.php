<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UUIDFeatureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('feature', function (Blueprint $table) {
            $table->uuid('feature_uuid')->after('id');
            $table->timestamp('revision_log')->after('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('feature', function (Blueprint $table) {
            //$table->dropColumn('feature_uuid');
            //$table->dropColumn('revision_log');
        });
    }
}
