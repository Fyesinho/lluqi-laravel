<?php

namespace App\Http\Controllers\API;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestimonialAPIController extends Controller{

    public function index(){
        $testimonials = Testimonial::all()->load('media');
        return response()->json([$testimonials], 200);
    }

}
