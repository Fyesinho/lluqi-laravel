<?php

namespace App;

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
        'name', 'email', 'password', 'gender', 'birthday', 'phone', 'role', 'gender_id', 'country_id', 'city_id',
        'language_id', 'language_id', 'language2_id', 'language3_id', 'language4_id',
        'facebook', 'vimeo'
    ];

    protected $casts = [
        'payment_at' => 'datetime'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


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
