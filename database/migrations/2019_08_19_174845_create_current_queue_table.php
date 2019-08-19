<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrentQueueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('current_queue', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('queue_id')->unsigned();
            $table->Integer('queue_count');
            $table->Integer('exit');
            $table->timestamps();
            
            $table->foreign('queue_id')
            ->references('id')
            ->on('diamond_queues')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('current_queue');
    }
}
