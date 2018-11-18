<?php

namespace App\Http\Controllers\Api\V1;

use App\Player;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePlayersRequest;
use App\Http\Requests\Admin\UpdatePlayersRequest;

class PlayersController extends Controller
{
    public function index()
    {
        return Player::with('team','scores')->get();
    }

    public function show($id)
    {

        return Player::with('team','scores')->findOrFail($id);
    }


    public function update(UpdatePlayersRequest $request, $id)
    {
        $Player = Player::findOrFail($id);
        $Player->update($request->all());
        return $Player;
    }

    public function store(StorePlayersRequest $request)
    {
        $Player = Player::create($request->all());
        

        return $Player;
    }

    public function destroy($id)
    {
        $Player = Player::findOrFail($id);
        $Player->delete();
        return '';
    }
}
