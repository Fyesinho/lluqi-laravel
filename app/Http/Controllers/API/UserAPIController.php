<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Auth\CreateUserAPIRequest;
use App\Http\Requests\API\Auth\LoginAPIRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserAPIController extends Controller{
    public function register(CreateUserAPIRequest $request){
        $data = [
            'name'      => request()->get('name'),
            'email'     => request()->get('email'),
            'gender'    => request()->get('gender'),
            'birthday'  => request()->get('birthday'),
            'phone'     => request()->get('phone'),
            'password'  => bcrypt(request()->get('password')),
        ];
        $user = User::create($data);
        return response()->json([$user], 200);
    }

    public function login(LoginApiRequest $request){
        $this->validateAttempt();

        $infoToken = $request->user()->createToken('PAT');
        $infoToken->token->expires_at = Carbon::now()->addDays(1);

        $infoToken->token->save();
        $data =  [
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

        $user->update($data);
        return response()->json([$user], 200);
    }

}
