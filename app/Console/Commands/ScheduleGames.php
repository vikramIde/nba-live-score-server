<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Game;
use App\Team;
use App\Jobs\ProcessGames;
class ScheduleGames extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'games:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $games = Game::where('status', 1)->get();

        foreach ($games as $game) {
            $team1 = Team::select()->where('id' , $game['team1_id'])->first();
            $team2 = Team::select()->where('id' , $game['team2_id'])->first();
            dispatch(new ProcessGames($game, $team1, $team2));
        }
    }
}
