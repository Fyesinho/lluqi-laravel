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
                   {!! Form::model($traveler, ['route' => ['travelers.update', $traveler->id], 'method' => 'patch', 'enctype' => 'multipart/form-data']) !!}

                        @include('travelers.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection