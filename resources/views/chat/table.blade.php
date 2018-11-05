<table class="table table-responsive" id="travelers-table">
    <thead>
    <tr>
        <th>Chat</th>
        <th>Integrantes</th>
        <th colspan="2">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($chats as $chat)
        <tr>
            <td>{!! $chat->id !!}</td>
            <td>
                @foreach($chat->users->pluck('name') as $name)
                    {!! $name !!},
                @endforeach
            </td>
            <td>
                <div class='btn-group'>
                    <a href="{!! route('chatById', [$chat->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>