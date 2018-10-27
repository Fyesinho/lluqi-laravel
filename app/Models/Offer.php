<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Offer
 * @package App\Models
 * @version October 19, 2018, 1:34 am UTC
 *
 * @property string offer
 */
class Offer extends Model
{
    use SoftDeletes;

    public $table = 'offers';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'offer'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'offer' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
