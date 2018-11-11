<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class TestimonialController extends Controller{

    public function index(){
        $testimonials = Testimonial::all();
        return view('testimonial.index',compact('testimonials'));
    }

    public function create(){
        return view('testimonial.create');
    }

    public function edit(Testimonial $testimonial){
        return view('testimonial.edit', compact('testimonial'));
    }

    public function store(Request $request){
        $data = request()->all();
        $image = request()->file('image');
        unset($data['image']);

        $testimonial = Testimonial::create($data);

        if(isset($image) && $image!=''){
            if($testimonial->getMedia('image')->count()>0){
                $testimonial->clearMediaCollection('image');
            }
            $testimonial->addMedia($image)->toMediaCollection('image');
        }

        Flash::success('Testimonial saved successfully.');
        return redirect()->route('testimonial.index');
    }

    public function update(Testimonial $testimonial, Request $request){
        $data = request()->all();
        $image = request()->file('image');
        unset($data['image']);

        if(isset($image) && $image!=''){
            if($testimonial->getMedia('image')->count()>0){
                $testimonial->clearMediaCollection('image');
            }
            $testimonial->addMedia($image)->toMediaCollection('image');
        }

        $testimonial->update($data);
        Flash::success('Testimonial updated successfully.');
        return redirect()->route('testimonial.index');
    }

    public function destroy(Testimonial $testimonial){
        $testimonial->delete();

        Flash::success('Testimonial deleted successfully.');
        return redirect()->route('testimonial.index');
    }


}
