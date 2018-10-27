<?php

namespace App\Models;

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

    public $table = 'need_activities';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'activity'
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

    
}
