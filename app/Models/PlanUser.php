<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PlanUser extends Model{

    protected $appends = ['expired_at'];

    public $fillable = [
        'id',
        'user_id',
        'plan_id',
        'active',
        'user_count_traveler',
        'created_at'
    ];

    protected $hidden = [
        'user_id', 'plan_id', 'updated_at'
    ];

    protected $casts = [
        'created_at'    => 'date:Y-m-d',
        'updated_at'    => 'date:Y-m-d',
        'expired_at'    => 'date:Y-m-d',
        'active'        => 'bool'
    ];

    public function getExpiredAtAttribute(){
        return Carbon::parse($this->created_at)->addYear();
    }
}
