<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class HostelMonth
 * @package App\Models
 * @version October 21, 2018, 9:01 pm UTC
 *
 * @property integer hostel_id
 * @property integer month_id
 */
class HostelMonth extends Model
{
    use SoftDeletes;

    public $table = 'hostel_months';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'hostel_id',
        'month_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'hostel_id' => 'integer',
        'month_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
