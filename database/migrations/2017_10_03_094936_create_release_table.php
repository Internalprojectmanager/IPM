<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReleaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('release', function (Blueprint $table) {
            $table->string('id',50);
            $table->string('project_id',50)->index();
            $table->string('name',200);
            $table->text('description');
            $table->double('versie');
            $table->string('author',255);
            $table->string('specificationtype',100);
            $table->primary('id');
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
        Schema::dropIfExists('release');
    }
}
