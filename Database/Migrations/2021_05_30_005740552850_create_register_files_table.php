<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegisterFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('register__files', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');

            // Your fields
            $table->string('folder')->nullable();
            $table->string('name');
            $table->string('type');
            $table->string('size');

            $table->integer('form_id')->unsigned()->nullable();
            $table->foreign('form_id')->references('id')->on('register__forms')->onDelete('SET NULL');

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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('register__files');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
