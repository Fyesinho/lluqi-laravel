@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Testimonio
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'testimonial.store', 'enctype' => 'multipart/form-data']) !!}
                    @include('testimonial.fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
