<table class="table table-responsive" id="travelers-table">
    <thead>
        <tr>
            <th>Usuario</th>
            <th>Descripción</th>
            <th>Fecha</th>
            <th colspan="2">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($testimonials as $testimonial)
        <tr>
            <td>{!! $testimonial->user !!}</td>
            <td>{!! $testimonial->description !!}</td>
            <td>{{ $testimonial->created_at }}</td>
            <td>
                {!! Form::open(['route' => ['testimonial.destroy', $testimonial->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    {{--<a href="{!! route('travelers.show', [$traveler->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                    <a href="{!! route('testimonial.edit', [$testimonial->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>