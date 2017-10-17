<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestrapportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testrapport', function (Blueprint $table) {
            $table->increments('id');
            $table->string('project_id',50)->index();
            $table->string('title',100);
            $table->string('description',255);
            $table->string('author',100);
            $table->string('status',50);

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
        Schema::dropIfExists('testrapport');
    }
}
