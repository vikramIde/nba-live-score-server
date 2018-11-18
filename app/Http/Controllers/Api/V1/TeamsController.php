<?php

namespace App\Http\Controllers\Api\V1;

use App\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTeamsRequest;
use App\Http\Requests\Admin\UpdateTeamsRequest;

class TeamsController extends Controller
{
    public function index()
    {
        return Team::with('players')->get();
    }

    public function show($id)
    {

        return Team::with('players')->findOrFail($id);
    }


    public function update(UpdateTeamsRequest $request, $id)
    {
        $Team = Team::findOrFail($id);
        $Team->update($request->all());
        return $Team;
    }

    public function store(StoreTeamsRequest $request)
    {
        $Team = Team::create($request->all());
        

        return $Team;
    }

    public function destroy($id)
    {
        $Team = Team::findOrFail($id);
        $Team->delete();
        return '';
    }
}
