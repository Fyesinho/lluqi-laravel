@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Prueba
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($prueba, ['route' => ['pruebas.update', $prueba->id], 'method' => 'patch']) !!}

                        @include('pruebas.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection