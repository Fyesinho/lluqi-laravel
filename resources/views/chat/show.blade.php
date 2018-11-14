@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Chats</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                @include('chat.messages')
            </div>
        </div>
        <div class="text-center">
            <p style="float: left;">Responder</p>
            {!! Form::open(['route' => 'chat.store']) !!}
            <input type="hidden" name="idChat" value="{{$idChat}}">
            <textarea style="width: 100%" rows="2" name="message"></textarea>
            {!! Form::submit('Responder', ['class' => 'btn btn-success']) !!}

            {!! Form::close() !!}

        </div>
    </div>
@endsection

