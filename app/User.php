<?php

namespace App;

use App\Models\NeedActivity;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    const ROLE_ADMIN = "ADMIN";
    const ROLE_TRAVELER = "TRAVELER";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'description', 'password', 'gender_id', 'birthday', 'phone', 'role', 'gender_id', 'country_id', 'city_id',
        'facebook', 'vimeo', 'payment_at',

        'native_language', 'language_id', 'language_id', 'language2_id', 'language3_id', 'language4_id',
        'instagram', 'youtube',
        'basic_help', 'advance_help',
        'about_me', 'experience',

        'is_premium'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userBasicHelp(){
        return $this->belongsToMany(NeedActivity::class, 'user_basic_help', null, 'need_activities_id');
    }

    public function userAdvancedHelp(){
        return $this->belongsToMany(NeedActivity::class, 'user_advance_help', null, 'need_activities_id');
    }

    public function scopeAdmin($query){
        return $query->whereRole(self::ROLE_ADMIN);
    }

    public function scopeTraveler($query){
        return $query->whereRole(self::ROLE_TRAVELER);
    }

    public function getRole(){
        switch($this->role){
            case self::ROLE_ADMIN:
                return "Administrador";

            case self::ROLE_TRAVELER:
                return "Viajero";

            default:
                return '';
        }
    }
}
