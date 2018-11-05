<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\ChatUser;
use App\User;
use Illuminate\Http\Request;

class ChatController extends Controller{

    public function chats(){
        $chats = Chat::all();
        foreach ($chats as $chat){
            $chat->users;
        }
        return view('chat.index', compact('chats'));
    }

    public function chatById($id){
        $chat = Chat::find($id);
        if (!isset($chat) || !$chat){
            return response()->json(['message' => 'Chat not found'], 400);
        }

        $messages = $chat->messages->load('user');
        //return response()->json($messages, 200);
        return view('chat.show', compact('messages'));
    }

}