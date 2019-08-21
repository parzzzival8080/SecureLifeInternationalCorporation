<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGenealogyMatchPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genealogy_match_points', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('genealogy_id');
            $table->bigInteger('matches')->default(0);
            $table->bigInteger('flushed_out_matches')->default(0);
            $table->bigInteger('product_points')->default(0);
            $table->bigInteger('incentives_points')->default(0);
            $table->bigInteger('left_group_sales_points')->default(0);
            $table->bigInteger('right_group_sales_points')->default(0);
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
        Schema::dropIfExists('genealogy_match_points');
    }
}
