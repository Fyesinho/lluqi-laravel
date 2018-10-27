@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Month
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($month, ['route' => ['months.update', $month->id], 'method' => 'patch']) !!}

                        @include('months.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection