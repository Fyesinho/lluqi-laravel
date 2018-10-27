<table class="table table-responsive" id="hostelOffers-table">
    <thead>
        <tr>
            <th>Hostel Id</th>
        <th>Offer Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($hostelOffers as $hostelOffer)
        <tr>
            <td>{!! $hostelOffer->hostel_id !!}</td>
            <td>{!! $hostelOffer->offer_id !!}</td>
            <td>
                {!! Form::open(['route' => ['hostelOffers.destroy', $hostelOffer->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('hostelOffers.show', [$hostelOffer->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('hostelOffers.edit', [$hostelOffer->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>