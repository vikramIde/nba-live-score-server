<?php
Route::get('/', function () { return redirect('/admin/home'); });

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('teams', 'Admin\TeamsController');
    Route::post('teams_mass_destroy', ['uses' => 'Admin\TeamsController@massDestroy', 'as' => 'teams.mass_destroy']);
    Route::post('teams_restore/{id}', ['uses' => 'Admin\TeamsController@restore', 'as' => 'teams.restore']);
    Route::delete('teams_perma_del/{id}', ['uses' => 'Admin\TeamsController@perma_del', 'as' => 'teams.perma_del']);
    Route::resource('players', 'Admin\PlayersController');
    Route::post('players_mass_destroy', ['uses' => 'Admin\PlayersController@massDestroy', 'as' => 'players.mass_destroy']);
    Route::post('players_restore/{id}', ['uses' => 'Admin\PlayersController@restore', 'as' => 'players.restore']);
    Route::delete('players_perma_del/{id}', ['uses' => 'Admin\PlayersController@perma_del', 'as' => 'players.perma_del']);
    Route::resource('games', 'Admin\GamesController');
    
    Route::post('games_mass_destroy', ['uses' => 'Admin\GamesController@massDestroy', 'as' => 'games.mass_destroy']);
    Route::post('games_restore/{id}', ['uses' => 'Admin\GamesController@restore', 'as' => 'games.restore']);
    Route::delete('games_perma_del/{id}', ['uses' => 'Admin\GamesController@perma_del', 'as' => 'games.perma_del']);
    Route::resource('rules', 'Admin\RulesController');
    Route::post('rules_mass_destroy', ['uses' => 'Admin\RulesController@massDestroy', 'as' => 'rules.mass_destroy']);
    Route::post('rules_restore/{id}', ['uses' => 'Admin\RulesController@restore', 'as' => 'rules.restore']);
    Route::delete('rules_perma_del/{id}', ['uses' => 'Admin\RulesController@perma_del', 'as' => 'rules.perma_del']);
    Route::resource('scores', 'Admin\ScoresController');
    Route::post('scores_mass_destroy', ['uses' => 'Admin\ScoresController@massDestroy', 'as' => 'scores.mass_destroy']);
    Route::post('scores_restore/{id}', ['uses' => 'Admin\ScoresController@restore', 'as' => 'scores.restore']);
    Route::delete('scores_perma_del/{id}', ['uses' => 'Admin\ScoresController@perma_del', 'as' => 'scores.perma_del']);



 
});
