<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatUser extends Model{

    protected $fillable = [
        'id', 'user_id', 'chat_id'
    ];
}
