<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testreport', function (Blueprint $table) {
            $table->increments('id');
            $table->string('release_id',50)->index();
            $table->string('title',100);
            $table->text('description');
            $table->double('version');
            $table->string('author',50);
            $table->string('status',50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('testreport');
    }
}
