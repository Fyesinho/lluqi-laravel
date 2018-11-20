@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Traveler
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($testimonial, ['route' => ['testimonial.update', $testimonial->id], 'method' => 'patch', 'enctype' => 'multipart/form-data']) !!}
                   @include('testimonial.fields')
                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection