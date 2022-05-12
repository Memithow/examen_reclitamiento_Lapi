<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRandomDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('random_data', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->nullable();
            $table->string('valid_card')->nullable();
            $table->string('token')->nullable();
            $table->string('invalid_card')->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->string('ccv')->nullable();
            $table->string('ccv_amex')->nullable();
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
        Schema::dropIfExists('random_data');
    }
}
