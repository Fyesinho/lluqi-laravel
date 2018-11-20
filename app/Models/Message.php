<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Message extends Model{

    protected $fillable = [
        'text', 'chat_id', 'user_id'
    ];

    protected $hidden = [
        'id', 'chat_id', 'updated_at', 'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
