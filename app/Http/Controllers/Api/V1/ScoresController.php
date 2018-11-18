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
        return Score::all();
    }

    public function show($id)
    {
        return Score::findOrFail($id);
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
