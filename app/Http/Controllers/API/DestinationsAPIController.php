<?php

namespace App\Http\Controllers\API;

use App\Models\City;
use App\Models\Destination;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;

class DestinationsAPIController extends Controller{

    public function index(){
        $destinations = Destination::all();
        foreach ($destinations as $destination){
            $destination->city = City::find($destination->city_id)->load('media');
            unset($destination->city_id);
        }
        return Response::json([
            'success' => true,
            'data'    => $destinations,
            'message' => 'Destinations retrieved successfully',
        ]);
    }

}
