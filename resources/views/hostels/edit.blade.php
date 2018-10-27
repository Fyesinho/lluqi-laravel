@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Hostel
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($hostel, ['route' => ['hostels.update', $hostel->id], 'method' => 'patch']) !!}

                        @include('hostels.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection