<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Game
 *
 * @package App
 * @property string $team1
 * @property string $team2
 * @property integer $results1
 * @property integer $results2
 * @property integer $status
*/
class Game extends Model
{
    use SoftDeletes;

    protected $fillable = ['results1', 'results2', 'status', 'team1_id', 'team2_id'];
    protected $hidden = [];
    
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setTeam1IdAttribute($input)
    {
        $this->attributes['team1_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setTeam2IdAttribute($input)
    {
        $this->attributes['team2_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setResults1Attribute($input)
    {
        $this->attributes['results1'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setResults2Attribute($input)
    {
        $this->attributes['results2'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setStatusAttribute($input)
    {
        $this->attributes['status'] = $input ? $input : null;
    }
    
    public function team1()
    {
        return $this->belongsTo(Team::class, 'team1_id')->withTrashed();
    }
    
    public function team2()
    {
        return $this->belongsTo(Team::class, 'team2_id')->withTrashed();
    }
    
}
