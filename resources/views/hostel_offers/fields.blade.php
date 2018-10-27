<!-- Hostel Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('hostel_id', 'Hostel Id:') !!}
    {!! Form::select('hostel_id', $hostels ,null, ['class' => 'form-control']) !!}
</div>

<!-- Offer Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('offer_id', 'Offer Id:') !!}
    {!! Form::select('offer_id', $offers, null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('hostelOffers.index') !!}" class="btn btn-default">Cancel</a>
</div>
