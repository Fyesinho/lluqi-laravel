@foreach ((array) session('flash_notification') as $message)
    @if (isset($message[0]->overlay) && $message[0]->overlay)
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message[0]->title,
            'body'       => $message[0]->message
        ])
    @else
        <div class="alert alert-{{ isset($message[0]->level) ? $message[0]->level : '' }} {{ isset($message[0]->important) ? ($message[0]->important ? 'alert-important' : '' ) : ''}}">
            @if (isset($message[0]->important))
                <button type="button"
                        class="close"
                        data-dismiss="alert"
                        aria-hidden="true"
                >&times;</button>
            @endif

            {!! isset($message[0]->message) ? $message[0]->message : '' !!}
        </div>
    @endif
@endforeach

{{ session()->forget('flash_notification') }}
