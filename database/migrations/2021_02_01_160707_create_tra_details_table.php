<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTraDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tra_details', function (Blueprint $table) {
            $table->id();
            $table->string('GId');
            $table->string('ENo');
            $table->string('UserId');
            $table->integer('time');
            $table->string('isActive');
            $table->double('totalTime');
            $table->double('accuracy');
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
        Schema::dropIfExists('tra_details');
    }
}
