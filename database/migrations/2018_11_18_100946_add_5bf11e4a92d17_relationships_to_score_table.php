<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5bf11e4a92d17RelationshipsToScoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scores', function(Blueprint $table) {
            if (!Schema::hasColumn('scores', 'games_id')) {
                $table->integer('games_id')->unsigned()->nullable();
                $table->foreign('games_id', '229888_5bf116b5a38ec')->references('id')->on('games')->onDelete('cascade');
                }
                if (!Schema::hasColumn('scores', 'players_id')) {
                $table->integer('players_id')->unsigned()->nullable();
                $table->foreign('players_id', '229888_5bf116b5b878b')->references('id')->on('players')->onDelete('cascade');
                }
                if (!Schema::hasColumn('scores', 'rules_id')) {
                $table->integer('rules_id')->unsigned()->nullable();
                $table->foreign('rules_id', '229888_5bf116b5d27e3')->references('id')->on('rules')->onDelete('cascade');
                }
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scores', function(Blueprint $table) {
            
        });
    }
}
