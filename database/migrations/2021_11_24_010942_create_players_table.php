<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('country');
            $table->integer('matchNumber');
            $table->integer('wins');
            $table->string('winRate');
            $table->integer('elo');
            $table->integer('localElo');
            $table->string('mostPlayedCiv');

            $table->integer('games20Sum');
            $table->integer('games2030Sum');
            $table->integer('games3040Sum');
            $table->integer('games40Sum');
            $table->integer('games20Win');
            $table->integer('games2030Win');
            $table->integer('games3040Win');
            $table->integer('games40Win');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('players');
    }
}
