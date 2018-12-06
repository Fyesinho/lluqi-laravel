<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Auth\CreateUserAPIRequest;
use App\Http\Requests\API\Auth\LoginAPIRequest;
use App\Mail\Mail;
use App\Models\Chat;
use App\Models\ChatUser;
use App\Models\Message;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use League\Flysystem\Config;


class UserAPIController extends Controller{
    public function register(CreateUserAPIRequest $request){
        $data = [
            'name'      => request()->get('name'),
            'email'     => request()->get('email'),
            'gender_id'    => request()->get('gender'),
            'birthday'  => request()->get('birthday'),
            'phone'     => request()->get('phone'),
            'password'  => bcrypt(request()->get('password')),
        ];
        $data['role'] = User::ROLE_TRAVELER;

        $user = User::create($data);
        Mail::newUser($user->name, $user->email);

        $chat = Chat::create();
        ChatUser::create([
            'user_id' => $user->id,
            'chat_id' => $chat->id
        ]);
        ChatUser::create([
            'user_id' => Config('app.user_support'),
            'chat_id' => $chat->id
        ]);

        Message::create([
            'text'      => Config('app.message_support'),
            'chat_id'   => $chat->id,
            'user_id'   => Config('app.user_support')
        ]);

        return response()->json([$user], 200);
    }

    public function login(LoginApiRequest $request){
        $this->validateAttempt();

        $infoToken = $request->user()->createToken('PAT');
        $infoToken->token->expires_at = Carbon::now()->addDays(1);
        $infoToken->token->save();

        $user = $request->user();
        $user->avatar = isset($user->getMedia('avatar')[0]) ? $user->getMedia('avatar')[0] : '';
        unset($user->media);

        $data =  [
            'user'      => $user,
            'token_type' => 'Bearer',
            'access_token' => $infoToken->accessToken,
            'expires_at' => Carbon::parse($infoToken->token->expires_at)->toDateTimeString()
        ];
        return response()->json($data);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Usuario deslogueado'
        ]);
    }

    private function validateAttempt(){
        if( !Auth::attempt(request(['email', 'password'])) ){
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    public function update(Request $request){
        $user = Auth::guard('api')->user();
        $data = $request->all();

        if(empty($data['password'])){
            unset($data['password']);
        }else {
            $data['password'] = bcrypt($data['password']);
        }

        $basic = isset($data['basic_help']) ? explode(",",$data['basic_help']) : [];
        if(empty($data['basic_help']) || $data['basic_help']!=""){
            $user->userBasicHelp()->sync($basic);
        }

        $advanced = isset($data['advanced_help']) ? explode(",",$data['advanced_help']) : [];
        if(empty($data['advanced_help']) || $data['advanced_help']!=""){
            $user->userAdvancedHelp()->sync($advanced);
        }

        unset($data['basic_help']);
        unset($data['advanced_help']);

        $avatar = request()->file('avatar');
        if(isset($avatar) && $avatar!=''){
            if($user->getMedia('avatar')->count()>0){
                $user->clearMediaCollection('avatar');
            }
            $user->addMedia($avatar)->toMediaCollection('avatar');
            unset($data['avatar']);
        }

        $user->update($data);
        $user->userBasicHelp;
        $user->userAdvancedHelp;
        $user->avatar = isset($user->getMedia('avatar')[0]) ? $user->getMedia('avatar')[0] : '';
        return response()->json([$user], 200);
    }

    public function getInfo(){
        $user = Auth::guard('api')->user();

        $user->avatar = isset($user->getMedia('avatar')[0]) ? $user->getMedia('avatar')[0] : '';
        $user->city;
        $user->gender;
        $user->userBasicHelp;
        $user->userAdvancedHelp;
        $user->plan = $user->getPlan();

        unset($user->gender_id);
        unset($user->city_id);
        unset($user->country_id);
        unset($user->media);

        return response()->json([$user], 200);
    }

}
