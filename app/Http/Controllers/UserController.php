<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Gender;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller{

    public function index(){
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create(){
        $genders = Gender::pluck('name','id');
        $roles = [
            User::ROLE_ADMIN => User::ROLE_ADMIN_TEXT,
            User::ROLE_TRAVELER => User::ROLE_TRAVELER_TEXT,
            User::ROLE_HOSTEL => User::ROLE_HOSTEL_TEXT
        ];

        return view('users.create', compact('user','genders', 'roles'));
    }

    public function edit(User $user){
        if(!isset($user) || !$user){
            return redirect()->route('user.index');
        }

        if($user->role == User::ROLE_TRAVELER){
            return redirect()->route('travelers.edit', $user->id);
        }

        $genders = Gender::pluck('name','id');
        $roles = [
            User::ROLE_ADMIN => User::ROLE_ADMIN_TEXT,
            User::ROLE_TRAVELER => User::ROLE_TRAVELER_TEXT,
            User::ROLE_HOSTEL => User::ROLE_HOSTEL_TEXT
        ];

        return view('users.edit', compact('user','genders', 'roles'));
    }

    public function store(UserStoreRequest $request){
        $input = $request->all();
        $user = User::create($input);
        $avatar = request()->file('avatar', '');

        if(isset($avatar) && $avatar!=''){
            $user->addMedia($avatar)->toMediaCollection('avatar');
        }

        if(empty($input['password'])){
            unset($input['password']);
        }else {
            $input['password'] = bcrypt($input['password']);
        }

        if($user->role == User::ROLE_TRAVELER){
            return redirect()->route('travelers.edit', $user->id);
        }

        return view('users.edit',compact('user'));
    }

    public function update(User $user, UserUpdateRequest $request){
        $input = request()->all();

        $avatar = request()->file('avatar', '');
        if(isset($avatar) && $avatar!=''){
            if($user->getMedia('avatar')->count()>0){
                $user->clearMediaCollection('avatar');
            }
            $user->addMedia($avatar)->toMediaCollection('avatar');
        }

        if(empty($input['password'])){
            unset($input['password']);
        }else {
            $input['password'] = bcrypt($input['password']);
        }

        $user->update($input);

        if($user->role == User::ROLE_TRAVELER){
            return redirect()->route('travelers.edit', $user->id);
        }

        return redirect()->route('user.edit', $user->id);
    }

}
