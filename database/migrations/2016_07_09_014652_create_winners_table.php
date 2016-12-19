<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWinnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('winners', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('season_id')->unsigned();
            $table->foreign('season_id')->references('id')->on('seasons')->onDelete('cascade');

            $table->integer('league_id')->unsigned();
            $table->foreign('league_id')->references('id')->on('leagues')->onDelete('cascade');

            $table->string('winning_team'); // set if only league type is league
            // the below are set only when it's a knockout type league
            $table->string('home_team');
            $table->string('away_team');
            $table->string('home_score');
            $table->string('away_score');
            $table->string('home_extra_score');
            $table->string('away_extra_score');
            $table->string('home_penalty_score');
            $table->string('away_penalty_score');
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
        Schema::drop('winners');
    }
}
