<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRequirementsTableV1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('requirement', function (Blueprint $table) {
            $table->string('release_id',50)->after('feature_id');
            $table->string('author',50)->after('status');
        });

        Schema::table('feature', function (Blueprint $table) {
            $table->string('author',50)->after('status');
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
            $table->dropColumn('release_id');
            $table->dropColumn('author');
        });

        Schema::table('feature', function (Blueprint $table) {
            $table->dropColumn('author');
        });
    }
}
