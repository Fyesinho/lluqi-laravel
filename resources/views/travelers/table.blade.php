<table class="table table-responsive" id="travelers-table">
    <thead>
        <tr>
            <th>Email</th>
        <th>Name</th>
        <th>Gender</th>
        <th>Birthday</th>
        <th>Password</th>
        <th>Phone</th>
        <th>Country Id</th>
        <th>City</th>
        <th>Language Id</th>
        <th>Language Id</th>
        <th>Language2 Id</th>
        <th>Language3 Id</th>
        <th>Language4 Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($travelers as $traveler)
        <tr>
            <td>{!! $traveler->email !!}</td>
            <td>{!! $traveler->name !!}</td>
            <td>{!! $traveler->gender !!}</td>
            <td>{!! $traveler->birthday !!}</td>
            <td>{!! $traveler->password !!}</td>
            <td>{!! $traveler->phone !!}</td>
            <td>{!! $traveler->country_id !!}</td>
            <td>{!! $traveler->city !!}</td>
            <td>{!! $traveler->language_id !!}</td>
            <td>{!! $traveler->language_id !!}</td>
            <td>{!! $traveler->language2_id !!}</td>
            <td>{!! $traveler->language3_id !!}</td>
            <td>{!! $traveler->language4_id !!}</td>
            <td>
                {!! Form::open(['route' => ['travelers.destroy', $traveler->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('travelers.show', [$traveler->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('travelers.edit', [$traveler->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>