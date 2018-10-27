<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class HostelOffer
 * @package App\Models
 * @version October 20, 2018, 6:47 pm UTC
 *
 * @property integer hostel_id
 * @property integer offer_id
 */
class HostelOffer extends Model
{
    use SoftDeletes;

    public $table = 'hostel_offers';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'hostel_id',
        'offer_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'hostel_id' => 'integer',
        'offer_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
