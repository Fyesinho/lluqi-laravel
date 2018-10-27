<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Traveler
 * @package App\Models
 * @version October 9, 2018, 1:55 am UTC
 *
 * @property string email
 * @property string name
 * @property string gender
 * @property integer birthday
 * @property string password
 * @property integer phone
 * @property integer country_id
 * @property string city
 * @property integer language_id
 * @property integer language2_id
 * @property integer language3_id
 * @property integer language4_id
 */
class Traveler extends Model
{
    use SoftDeletes;

    public $table = 'travelers';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'email',
        'name',
        'gender',
        'birthday',
        'password',
        'phone',
        'country_id',
        'city',
        'language_id',
        'language_id',
        'language2_id',
        'language3_id',
        'language4_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'email' => 'string',
        'name' => 'string',
        'gender' => 'string',
        'birthday' => 'integer',
        'password' => 'string',
        'phone' => 'integer',
        'country_id' => 'integer',
        'city' => 'string',
        'language_id' => 'integer',
        'language2_id' => 'integer',
        'language3_id' => 'integer',
        'language4_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
