<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBronzeWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bronze_wallets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('genealogy_id');
            $table->bigInteger('current_balance')->default(0);
            $table->bigInteger('total_earnings')->default(0);
            $table->timestamps();

            $table->foreign('genealogy_id')->references('id')->on('genealogies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bronze_wallets');
    }
}
