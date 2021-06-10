<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegisterFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('register__forms', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');

            // Your fields
            $table->string('company');
            $table->string('identity_no');
            $table->string('signatory');
            $table->string('email');
            $table->string('work_phone');
            $table->string('mobile_phone');
            $table->string('reference_no');

            $table->integer('collateral_id')->unsigned()->nullable();
            $table->foreign('collateral_id')->references('id')->on('register__collaterals')->onDelete('SET NULL');

            $table->float('collateral_amount',10,2);

            $table->float('monthly_consumption', 10, 2);
            $table->text('credit_card')->nullable();

            $table->mediumText('shipping_address');

            $table->tinyInteger('agreement1');
            $table->tinyInteger('agreement2');

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
        Schema::dropIfExists('register__forms');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
