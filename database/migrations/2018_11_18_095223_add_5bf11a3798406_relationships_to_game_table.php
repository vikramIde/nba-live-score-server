<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5bf11a3798406RelationshipsToGameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('games', function(Blueprint $table) {
            if (!Schema::hasColumn('games', 'team1_id')) {
                $table->integer('team1_id')->unsigned()->nullable();
                $table->foreign('team1_id', '229753_5bf02eedc0d02')->references('id')->on('teams')->onDelete('cascade');
                }
                if (!Schema::hasColumn('games', 'team2_id')) {
                $table->integer('team2_id')->unsigned()->nullable();
                $table->foreign('team2_id', '229753_5bf02eedd618b')->references('id')->on('teams')->onDelete('cascade');
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
        Schema::table('games', function(Blueprint $table) {
            
        });
    }
}
