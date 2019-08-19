<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWalletLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('wallet_id')->unsigned();
            $table->bigInteger('amount');
            $table->string('remarks');
            $table->timestamps();
            
            $table->foreign('wallet_id')
            ->references('id')
            ->on('wallet')
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
        Schema::dropIfExists('wallet_logs');
    }
}
