<?php

namespace App\Http\Controllers\API;

use App\Mail\Mail;
use App\Models\Chat;
use App\Models\ChatUser;
use App\Models\Message;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ChatAPIController extends Controller{

    public function createChat(){
        $user = Auth::guard('api')->user();
        $userId = request()->get('user_id');

        if(!isset($userId) || $userId==null){
            return response()->json(['message' => 'user_id is required'], 400);
        }

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

        $messages = $chat->messages->load('user')->sortByDesc('created_at');
        return response()->json($messages, 200);
    }

    public function newMessage($idChat){
        $user = Auth::guard('api')->user();
        $message = request()->get('message','');

        $chat = Chat::find($idChat);
        if (!isset($chat) || !$chat){
            return response()->json(['message' => 'Chat not found'], 400);
        }

        Message::create([
            'text'      => $message,
            'chat_id'   => $idChat,
            'user_id'   => $user->id
        ]);

        if($user->role == User::ROLE_HOSTEL){
            $travelers = $chat->users->where("role", User::ROLE_TRAVELER);
            foreach ($travelers as $traveler){
                $nameHostel = $user->name . " (Hostal" .$user->hostels->name_hostel . ")";
                Mail::newMessage($traveler->name, $traveler->email, $traveler->name, $nameHostel,User::ROLE_TRAVELER);
            }
        }

        if($user->role == User::ROLE_TRAVELER){
            $hostels = $chat->users->where("role", User::ROLE_HOSTEL);
            foreach ($hostels as $hostel){
                if(isset($hostel->hostels)){
                    $nameHostel = $hostel->name . " (Hostal " .$hostel->hostels->name_hostel . ")";
                    Mail::newMessage($nameHostel, $hostel->email, $user->name, $nameHostel, User::ROLE_HOSTEL);
                }
            }
        }

        return response()->json(null, 200);
    }


}
