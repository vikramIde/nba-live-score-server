<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Team
 *
 * @package App
 * @property string $name
*/
class Team extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];
    protected $hidden = [];
    
	public function players()
    {
        return $this->hasMany(Player::class, 'team_id','id')->withTrashed();
    }
    
}
