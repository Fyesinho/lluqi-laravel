@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Hostels</h1>

        <h1 class="pull-right">
            <a class="btn btn-primary pull-right" style="margin-bottom: 5px" href="{!! route('hostels.create') !!}">Add New</a>
        </h1>

        <div class="col-xs-12 col-sm-4 pull-right" style="margin-bottom: 10px">
            {!! Form::open(['route' => ['hostels.index'], 'method' => 'GET']) !!}
            <div style="display: flex;">
                <span style="margin: 5px 5px 0 0">Buscar </span>
                <input name="s" value="{{ request()->get('s') }}" class="form-control">
            </div>
            {!! Form::close() !!}
        </div>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('hostels.table')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

