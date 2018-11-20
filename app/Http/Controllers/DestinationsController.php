<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationsController extends Controller{

    public function index(){
        $destinations = Destination::all();
        return view('destination.index', compact('destinations'));
    }

    public function create(){
        $cities = City::all()->pluck('city','id');
        return view('destination.create', compact('cities'));
    }

    public function store(Request $request){
        Destination::create(request()->all());
        return redirect()->route('destination.index');
    }

    public function destroy(Destination $destination){
        $destination->delete();
        return redirect()->route('destination.index');
    }

}
