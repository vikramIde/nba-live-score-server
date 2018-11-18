<?php

use Illuminate\Database\Seeder;

class RuleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => '2 pointer', 'value' => 2,],
            ['id' => 2, 'name' => '3 pointer', 'value' => 3,],
            ['id' => 3, 'name' => 'Out (of court)', 'value' => null,],
            ['id' => 4, 'name' => 'Foul ', 'value' => null,],
            ['id' => 5, 'name' => 'Double Dribble', 'value' => null,],

        ];

        foreach ($items as $item) {
            \App\Rule::create($item);
        }
    }
}
