<?php

namespace App\Http\Controllers\API;

use App\Mail\Mail;
use App\Models\Postulation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostulationAPIController extends Controller{

    public function store(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
        ]);

        $email = request()->get('email');
        Postulation::create([
            "email" => $email
        ]);

        return response()->json();
    }
}
