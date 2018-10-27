@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Month
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('months.show_fields')
                    <a href="{!! route('months.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
