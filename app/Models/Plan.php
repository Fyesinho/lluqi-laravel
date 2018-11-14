<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model{

    public $fillable = [
        'id',
        'name',
        'description',
        'user_id',
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function users(){
        return $this->belongsToMany(User::class);
    }

}
