<table class="table table-responsive" id="hostelMonths-table">
    <thead>
        <tr>
            <th>Hostel Id</th>
        <th>Month Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($hostelMonths as $hostelMonth)
        <tr>
            <td>{!! $hostelMonth->hostel_id !!}</td>
            <td>{!! $hostelMonth->month_id !!}</td>
            <td>
                {!! Form::open(['route' => ['hostelMonths.destroy', $hostelMonth->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('hostelMonths.show', [$hostelMonth->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('hostelMonths.edit', [$hostelMonth->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>