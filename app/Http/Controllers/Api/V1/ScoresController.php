<?php

namespace App\Http\Controllers\Api\V1;

use App\Score;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreScoresRequest;
use App\Http\Requests\Admin\UpdateScoresRequest;

class ScoresController extends Controller
{
    public function index()
    {
        return Score::with('games', 'players','rules')->get();
    }

    public function show($id)
    {

        return Score::with('games', 'players','rules')->findOrFail($id);
    }

    public function showByGamesId($id)
    {

        return Score::with('games', 'players','rules')->where('games_id', '=', $id)->get();
    }

    public function update(UpdateScoresRequest $request, $id)
    {
        $score = Score::findOrFail($id);
        $score->update($request->all());
        return $score;
    }

    public function store(StoreScoresRequest $request)
    {
        $score = Score::create($request->all());
        

        return $score;
    }

    public function destroy($id)
    {
        $score = Score::findOrFail($id);
        $score->delete();
        return '';
    }
}
