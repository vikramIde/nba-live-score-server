<?php

namespace App\Http\Controllers\Api\V1;

use App\Game;
use App\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreGamesRequest;
use App\Http\Requests\Admin\UpdateGamesRequest;
use App\Jobs\ProcessGames;

class GamesController extends Controller
{
    public function index()
    {
        return Game::with('team1', 'team2')->get();
    }

    public function show($id)
    {

        return Game::with('team1', 'team2')->findOrFail($id);
    }


    public function update(UpdateGamesRequest $request, $id)
    {
        $Game = Game::findOrFail($id);
        $Game->update($request->all());
        return $Game;
    }

    public function store(StoreGamesRequest $request)
    {
        $Game = Game::create($request->all());
        

        return $Game;
    }

    public function destroy($id)
    {
        $Game = Game::findOrFail($id);
        $Game->delete();
        return '';
    }

    public function startGame()
    {
        $games = Game::where('status', 1)->get();

        foreach ($games as $game) {
            $team1 = Team::select()->where('id' , $game['team1_id'])->first();
            $team2 = Team::select()->where('id' , $game['team2_id'])->first();
            dispatch(new ProcessGames($game, $team1, $team2));
        }
    }
}
