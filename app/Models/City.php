<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

/**
 * Class City
 * @package App\Models
 * @version October 17, 2018, 3:26 am UTC
 *
 * @property string city
 * @property integer country_id
 */
class City extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'cities';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'city',
        'country_id',
        'description',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'city' => 'string',
        'country_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function country() {
        return $this->belongsTo(Country::class);
    }
    
}
