<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class HostelActivity
 * @package App\Models
 * @version October 20, 2018, 2:58 pm UTC
 *
 * @property integer hostel_id
 * @property integer activity_id
 */
class HostelActivity extends Model
{
    use SoftDeletes;

    public $table = 'hostel_activities';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'hostel_id',
        'activity_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'hostel_id' => 'integer',
        'activity_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
