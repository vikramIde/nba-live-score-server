<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Score
 *
 * @package App
 * @property string $games
 * @property string $players
 * @property string $rules
*/
class Score extends Model
{
    use SoftDeletes;

    protected $fillable = ['games_id', 'players_id', 'rules_id'];
    protected $hidden = [];
    
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setGamesIdAttribute($input)
    {
        $this->attributes['games_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setPlayersIdAttribute($input)
    {
        $this->attributes['players_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setRulesIdAttribute($input)
    {
        $this->attributes['rules_id'] = $input ? $input : null;
    }
    
    public function games()
    {
        return $this->belongsTo(Game::class, 'games_id')->withTrashed();
    }
    
    public function players()
    {
        return $this->belongsTo(Player::class, 'players_id')->withTrashed();
    }
    
    public function rules()
    {
        return $this->belongsTo(Rule::class, 'rules_id')->withTrashed();
    }
    
}
