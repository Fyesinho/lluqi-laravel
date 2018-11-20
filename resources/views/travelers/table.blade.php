<table class="table table-responsive" id="travelers-table">
    <thead>
        <tr>
        <th>Email</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Country</th>
        <th>City</th>
            <th colspan="2">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($travelers as $traveler)
        <tr>
            <td>{!! $traveler->email !!}</td>
            <td>{!! $traveler->name !!}</td>
            <td>{!! $traveler->phone !!}</td>
            <td>{!! isset($traveler->country) ? $traveler->country->name : '' !!}</td>
            <td>{!! isset($traveler->city) ? $traveler->city : '' !!}</td>
            <td>
                {!! Form::open(['route' => ['travelers.destroy', $traveler->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    {{--<a href="{!! route('travelers.show', [$traveler->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                    <a href="{!! route('travelers.edit', [$traveler->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>