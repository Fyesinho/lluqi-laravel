<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $offer->id !!}</p>
</div>

<!-- Offer Field -->
<div class="form-group">
    {!! Form::label('offer', 'Offer:') !!}
    <p>{!! $offer->offer !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $offer->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $offer->updated_at !!}</p>
</div>

