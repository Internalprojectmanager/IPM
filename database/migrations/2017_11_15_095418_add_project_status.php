<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProjectStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**Schema::table('company', function (Blueprint $table) {
            $table->dropColumn('color');
        });
**/
        Schema::table('project', function (Blueprint $table) {
            $table->enum('status', ['Draft','In Progress','Canceled','Paused'])->default('Draft')->after('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('company', function (Blueprint $table) {
            $table->string('color', 7)->after('description')->nullable();
        });
    }
}
