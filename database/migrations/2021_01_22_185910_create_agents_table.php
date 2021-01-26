<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_number');
            $table->string('phone_number',15);
            $table->string('name');
            $table->string('email');
            $table->integer('votes');
            $table->timestamps();
            $table->integer('stream_id')->unsigned();
            $table->foreign('stream_id')
                    ->references('id')
                    ->on('streams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agents');
    }
}
