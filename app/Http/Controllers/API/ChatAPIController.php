<?php

namespace App\Http\Controllers\API;

use App\Models\Chat;
use App\Models\ChatUser;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ChatAPIController extends Controller{

    public function createChat(){
        $user = Auth::guard('api')->user();
        $userId = request()->get('user_id');

        $chat = Chat::create();

        ChatUser::create([
            'user_id' => $user->id,
            'chat_id' => $chat->id
        ]);

        ChatUser::create([
            'user_id' => $userId,
            'chat_id' => $chat->id
        ]);

        return response()->json(['message' => 'Chat create successfully'], 200);
    }

    public function chats(){
        $user = Auth::guard('api')->user();
        $chats = $user->chats->load('users');
        return response()->json($chats, 200);
    }

    public function messages($idChat){
        $chat = Chat::find($idChat);
        if (!isset($chat) || !$chat){
            return response()->json(['message' => 'Chat not found'], 400);
        }

        $messages = $chat->messages->load('user');
        return response()->json($messages, 200);
    }

    public function newMessage($idChat){
        $user = Auth::guard('api')->user();
        $message = request()->get('message','');

        Message::create([
            'text'      => $message,
            'chat_id'   => $idChat,
            'user_id'   => $user->id
        ]);

        return response()->json(null, 200);
    }


}
