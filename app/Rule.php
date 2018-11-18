<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Rule
 *
 * @package App
 * @property string $name
 * @property integer $value
*/
class Rule extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'value'];
    protected $hidden = [];
    
    

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setValueAttribute($input)
    {
        $this->attributes['value'] = $input ? $input : null;
    }
    
}
