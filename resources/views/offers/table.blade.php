<table class="table table-responsive" id="offers-table">
    <thead>
        <tr>
            <th>Offer</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($offers as $offer)
        <tr>
            <td>{!! $offer->offer !!}</td>
            <td>
                {!! Form::open(['route' => ['offers.destroy', $offer->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('offers.show', [$offer->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('offers.edit', [$offer->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>