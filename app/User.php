<?php

namespace App;

use App\Models\Chat;
use App\Models\City;
use App\Models\Country;
use App\Models\Gender;
use App\Models\Hostel;
use App\Models\NeedActivity;
use App\Models\Plan;
use App\Models\PlanUser;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class User extends Authenticatable implements HasMedia
{
    use Notifiable, HasApiTokens, HasMediaTrait;

    /* ------------------------ ROLES  -------------------------*/
    const ROLE_ADMIN            = "ADMIN";
    const ROLE_ADMIN_TEXT       = "Administrador";

    const ROLE_TRAVELER         = "TRAVELER";
    const ROLE_TRAVELER_TEXT    = "Viajero";

    const ROLE_HOSTEL           = "HOSTEL";
    const ROLE_HOSTEL_TEXT      = "Hostal";

    /* ------------------------ TYPE PREMIUM TRAVELER ----------------------- */
    const TRAVELER_TYPE_PRO         = 'is_pro';
    const TRAVELER_TYPE_PRO_TEXT    = 'PRO';

    const TRAVELER_TYPE_PROPLUS     = 'is_proplus';
    const TRAVELER_TYPE_PROPLUS_TEXT= 'PRO PLUS';

    const TRAVELER_TYPE_GOLD        = 'is_gold';
    const TRAVELER_TYPE_GOLD_TEXT   = 'GOLD';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'description', 'password', 'gender_id', 'birthday', 'phone', 'role', 'country_id',
        'city_id', 'city',
        'facebook', 'vimeo', 'payment_at',

        'native_language', 'language_id', 'language_id', 'language2_id', 'language3_id', 'language4_id',
        'instagram', 'youtube',
        'basic_help', 'advance_help',
        'about_me', 'experience',

        'is_premium'
    ];

    protected $casts = [
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /* ---- Relationship ---- */

    public function userBasicHelp(){
        return $this->belongsToMany(NeedActivity::class, 'user_basic_help', null, 'need_activities_id');
    }

    public function userAdvancedHelp(){
        return $this->belongsToMany(NeedActivity::class, 'user_advance_help', null, 'need_activities_id');
    }

    /*public function city(){
        return $this->belongsTo(City::class);
    }*/

    public function gender(){
        return $this->belongsTo(Gender::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function chats(){
        return $this->belongsToMany(Chat::class, 'chat_users');
    }

    public function hostels(){
        return $this->hasOne(Hostel::class);
    }

    /* ---------------------- */


    /* ------- Scope -------- */
    public function scopeAdmin($query){
        return $query->whereRole(self::ROLE_ADMIN);
    }

    public function scopeTraveler($query){
        return $query->whereRole(self::ROLE_TRAVELER);
    }

    public function scopeHostel($query){
        return $query->whereRole(self::ROLE_HOSTEL);
    }
    /* ---------------------- */

    public function getRole(){
        switch($this->role){
            case self::ROLE_ADMIN:
                return self::ROLE_ADMIN_TEXT;

            case self::ROLE_TRAVELER:
                return self::ROLE_TRAVELER_TEXT;

            case self::ROLE_HOSTEL:
                return self::ROLE_HOSTEL_TEXT;

            default:
                return '';
        }
    }

    public function getPlan(){
        $planUser = PlanUser::where([['user_id',$this->id],['active',true]])->first();
        if(isset($planUser) && $planUser){
            return $plan = Plan::find($planUser->plan_id);
        }
        return [];
    }
}
