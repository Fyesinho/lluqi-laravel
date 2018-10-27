@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Need Activity
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($needActivity, ['route' => ['needActivities.update', $needActivity->id], 'method' => 'patch']) !!}

                        @include('need_activities.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection