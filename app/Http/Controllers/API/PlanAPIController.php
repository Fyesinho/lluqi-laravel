<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePlanUserRequest;
use App\Models\Plan;
use App\Models\PlanUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PlanAPIController extends Controller{

    public function index(){
        $user = Auth::guard('api')->user();

        $plans = PlanUser::where('user_id',$user->id)->get();
        foreach ($plans as $plan){
            $plan->plan = Plan::find($plan->plan_id);
        }
        return response()->json([$plans], 200);
    }

    public function store(CreatePlanUserRequest $request){
        $user = Auth::guard('api')->user();
        $plan = Plan::find(request()->get('plan_id'));

        $planValidate = PlanUser::where([['user_id',$user->id],['plan_id', $plan->id]])->get();
        if(count($planValidate)>0){
            return response()->json(['code'=>400, 'message' => 'Ya posees este Plan contratado'], 200);
        }

        $date = Carbon::now();
        $planUser = PlanUser::where([['user_id',$user->id],['active',true]])->first();
        if(isset($planUser) && $planUser){
            $date = $planUser->expired_at;
        }

        $active = true;
        $planUser = PlanUser::where('user_id',$user->id)->first();
        if(isset($planUser) && $planUser){
            $active=false;
        }

        $planUser = PlanUser::create([
            'user_id'   => $user->id,
            'plan_id'   => $plan->id,
            'created_at'=> $date,
            'active'    => $active
        ]);

        return response()->json([$planUser], 201);
    }

    /*public function update($planId, Request $request){
        $user = Auth::guard('api')->user();
        $plan = Plan::find($planId);

        $planUser = PlanUser::where([['user_id',$user->id],['plan_id', $plan->id]])->update(request()->all());
        if($planUser){
            return response()->json(['code'=> 200, 'message' => 'Plan actualizado correctamente'], 200);
        }
        return response()->json(['code'=> 400, 'message' => 'Plan no se ha actualizado'], 200);
    }*/
}
