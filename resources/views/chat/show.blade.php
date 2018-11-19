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
        @if(in_array(env('CHAT_USERID'),$chat->users->pluck('id')->toArray()))
            <div class="text-center">
                <p style="float: left;">Responder</p>
                {!! Form::open(['route' => 'chat.store']) !!}

                <input type="hidden" name="idChat" value="{{$idChat}}">
                <textarea style="width: 100%" rows="2" name="message"></textarea>

                {!! Form::submit('Responder', ['class' => 'btn btn-success']) !!}
                {!! Form::close() !!}
            </div>
        @else
            <div class="text-center" style="border: 1px solid red ; padding: 30px 0;">
                <p style="font-weight: bold;font-size: 15px; margin: 0">Chat equivocado</p>
                <p style="font-weight: bold;font-size: 13px; margin: 0">No puedes escribir mensajes</p>
            </div
        @endif
    </div>
@endsection

