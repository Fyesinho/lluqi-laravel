<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Hostel
 * @package App\Models
 * @version October 20, 2018, 1:13 am UTC
 *
 * @property string name_hostel
 * @property string name_host
 * @property integer city_id
 * @property string main_picture
 * @property integer verified
 * @property integer start_stay
 * @property integer end_stay
 * @property integer travelers_reciebed
 * @property integer calification
 * @property string web
 * @property string description
 */
class Hostel extends Model
{
    use SoftDeletes;

    public $table = 'hostels';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'avatar',
        'name_hostel',
        'name_host',
        'city_id',
        'main_picture',
        'verified',
        'start_stay',
        'end_stay',
        'travelers_reciebed',
        'calification',
        'web',
        'phone',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'avatar' => 'string',
        'name_hostel' => 'string',
        'name_host' => 'string',
        'city_id' => 'integer',
        'main_picture' => 'string',
        'verified' => 'integer',
        'start_stay' => 'integer',
        'end_stay' => 'integer',
        'travelers_reciebed' => 'integer',
        'calification' => 'integer',
        'web' => 'string',
        'phone' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
    ];

    public function city() {
        return $this->belongsTo(City::class);
    }

    public function images() {
        return $this->hasMany(Images::class);
    }

    public function months() {
        return $this->belongsToMany(Month::class, 'hostel_months');
    }

    public function offers() {
        return $this->belongsToMany(Offer::class, 'hostel_offers');
    }

    public function activities() {
        return $this->belongsToMany(NeedActivity::class, 'hostel_activities', 'hostel_id', 'activity_id');
    }
    
}
