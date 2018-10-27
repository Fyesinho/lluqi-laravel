<table class="table table-responsive" id="hostels-table">
    <thead>
        <tr>
        <th>Nombre Hostal</th>
        <th>Avatar</th>
        <th>Nombre Anfitrión</th>
        <th>Ciudad</th>
        <th>Foto Principal</th>
        <th>Perfil Verificado</th>
        <th>Semanas Mínimas</th>
        <th>Semanas Máximas</th>
        <th>Viajeros Recibidos</th>
        <th>Calificación</th>
        <th>Web</th>
        <th>Phone</th>
        <th>Descripción</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($hostels as $hostel)
        <tr>
            <td>{!! $hostel->name_hostel !!}</td>
            <td><img src="{{URL::asset($hostel->avatar)}}" alt="profile Pic" height="40" width="40"/></td>
            <td>{!! $hostel->name_host !!}</td>
            <td>{!! $hostel->city_id !!}
            <td><img src="{{URL::asset($hostel->main_picture)}}" alt="profile Pic" height="40"/></td>
            <td>{!! $hostel->verified !!}</td>
            <td>{!! $hostel->start_stay !!}</td>
            <td>{!! $hostel->end_stay !!}</td>
            <td>{!! $hostel->travelers_reciebed !!}</td>
            <td>{!! $hostel->calification !!}</td>
            <td>{!! $hostel->web !!}</td>
            <td>{!! $hostel->phone !!}</td>
            <td>{!! $hostel->description !!}</td>
            <td>
                {!! Form::open(['route' => ['hostels.destroy', $hostel->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('hostels.show', [$hostel->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('hostels.edit', [$hostel->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>