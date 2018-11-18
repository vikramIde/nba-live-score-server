<?php

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {

        Route::resource('scores', 'ScoresController', ['except' => ['create', 'edit']]);
        Route::resource('games', 'GamesController', ['except' => ['create', 'edit']]);
        Route::resource('players', 'PlayersController', ['except' => ['create', 'edit']]);
        Route::resource('teams', 'TeamsController', ['except' => ['create', 'edit']]);
        Route::get('scores/game/{gameid}', 'ScoresController@showByGamesId');

        Route::get('start-game', 'GamesController@startGame');
});
