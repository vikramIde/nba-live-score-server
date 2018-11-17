<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5bf02ab5b7b57RelationshipsToPlayerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('players', function(Blueprint $table) {
            if (!Schema::hasColumn('players', 'team_id')) {
                $table->integer('team_id')->unsigned()->nullable();
                $table->foreign('team_id', '229752_5bf02ab47f03a')->references('id')->on('teams')->onDelete('cascade');
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
        Schema::table('players', function(Blueprint $table) {
            
        });
    }
}
