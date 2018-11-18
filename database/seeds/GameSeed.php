<?php

use Illuminate\Database\Seeder;

class GameSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'team1_id' => 1, 'team2_id' => 2, 'results1' => null, 'results2' => null, 'status' => 1,],
            ['id' => 2, 'team1_id' => 3, 'team2_id' => 4, 'results1' => null, 'results2' => null, 'status' => 1,],

        ];

        foreach ($items as $item) {
            \App\Game::create($item);
        }
    }
}
