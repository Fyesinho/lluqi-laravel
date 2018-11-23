<?php

namespace App\Models;

use App\User;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class NeedActivity
 * @package App\Models
 * @version October 19, 2018, 1:17 am UTC
 *
 * @property string activity
 */
class NeedActivity extends Model
{
    use SoftDeletes;

    const TYPE_BASIC = 'BASIC';
    const TYPE_ADVANCED = 'ADVANCED';

    public $table = 'need_activities';
    

    protected $dates = ['deleted_at'];

    protected $hidden = [
        'type', 'deleted_at', 'created_at', 'updated_at'
    ];

    public $fillable = [
        'activity', 'type'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'activity' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function scopeBasic($query){
        $query->whereType(self::TYPE_BASIC);
    }

    public function scopeAdvanced($query){
        $query->whereType(self::TYPE_ADVANCED);
    }



    public function getType(){
        return self::getTypes()[$this->type];
    }

    public static function getTypes(){
        return [
            ''=> 'Sin asignar',
            self::TYPE_BASIC => 'Basica',
            self::TYPE_ADVANCED => 'Avanzada'
        ];
    }

}
