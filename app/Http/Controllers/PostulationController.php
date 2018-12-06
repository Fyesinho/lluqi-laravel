<?php

namespace App\Http\Controllers;

use App\Models\Postulation;
use Illuminate\Http\Request;

class PostulationController extends Controller{

    public function index(){
        $postulations = Postulation::all();
        return view('postulations.index' ,compact('postulations'));
    }
}
