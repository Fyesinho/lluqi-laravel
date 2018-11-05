<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model{

    public function users(){
        return $this->belongsToMany(User::class, 'chat_users');
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }
}
