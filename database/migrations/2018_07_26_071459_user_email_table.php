<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserEmailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_email', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('provider', 20);
            $table->string('provider_id', 30)->nullable();
            $table->string('email', 30);
            $table->string('verificationcode', 100)->nullable();
            $table->boolean('active')->default(false);


            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->boolean('verified')->after('toc')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_email');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('verified');
        });

    }
}
