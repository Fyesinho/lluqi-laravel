<table class="table table-responsive" id="hostelActivities-table">
    <thead>
        <tr>
            <th>Hostel Id</th>
        <th>Activity Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($hostelActivities as $hostelActivity)
        <tr>
            <td>{!! $hostelActivity->hostel_id !!}</td>
            <td>{!! $hostelActivity->activity_id !!}</td>
            <td>
                {!! Form::open(['route' => ['hostelActivities.destroy', $hostelActivity->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('hostelActivities.show', [$hostelActivity->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('hostelActivities.edit', [$hostelActivity->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>