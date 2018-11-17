<?php

use Illuminate\Database\Seeder;

class TeamSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Atlanta Hawks',],
            ['id' => 2, 'name' => 'Golden State Warrior',],
            ['id' => 3, 'name' => 'San Antonio Spurs',],
            ['id' => 4, 'name' => 'Memphis Grizzles',],

        ];

        foreach ($items as $item) {
            \App\Team::create($item);
        }
    }
}
