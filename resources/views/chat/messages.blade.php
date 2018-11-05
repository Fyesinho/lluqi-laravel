<div>

    @foreach($messages as $message)
        <div class="col-xs-12">
            <div class="col-xs-12 col-sm-7 col-sm-offset-2" style="border: 1px solid #0f8ec1; margin-bottom: 10px; text-align: center; padding-top: 5px">
                <div style="font-size: 16px">
                    {!! $message->text !!}
                </div>
                <div style="font-size: 10px">
                    <p>{{ $message->user->name }}</p>
                </div>
            </div>
        </div>
    @endforeach

</div>