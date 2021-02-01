<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tras', function (Blueprint $table) {
            $table->id();
            $table->string('GId');
            $table->integer('time');
            $table->string('UserId');
            $table->string('isActive');
            $table->double('totalTime')->nullable();
            $table->double('accuracy')->nullable();
            $table->date('date');
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
        Schema::dropIfExists('tras');
    }
}
