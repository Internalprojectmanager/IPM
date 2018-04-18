<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ClientUpdateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('company', 'client');

        Schema::table('client', function (Blueprint $table) {
            $table->string('contactname')->nullable()->after('description');
            $table->string('contactnumber')->nullable()->after('contactname');
            $table->string('contactemail')->nullable()->after('contactnumber');
            $table->enum('status', ['Client','Lead','Prospect','No Partners Anymore'])->nullable()->after('contactemail');

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
