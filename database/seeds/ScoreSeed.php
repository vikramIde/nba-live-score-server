<?php

use Illuminate\Database\Seeder;

class ScoreSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'games_id' => 1, 'players_id' => 3, 'rules_id' => 4,],

        ];

        foreach ($items as $item) {
            \App\Score::create($item);
        }
    }
}
