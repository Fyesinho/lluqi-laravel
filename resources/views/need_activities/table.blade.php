<table class="table table-responsive" id="needActivities-table">
    <thead>
        <tr>
            <th>Activity</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($needActivities as $needActivity)
        <tr>
            <td>{!! $needActivity->activity !!}</td>
            <td>
                {!! Form::open(['route' => ['needActivities.destroy', $needActivity->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('needActivities.show', [$needActivity->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('needActivities.edit', [$needActivity->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>