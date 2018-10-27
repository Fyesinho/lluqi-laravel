<!-- Hostel Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('hostel_id', 'Hostel Id:') !!}
    {!! Form::select('hostel_id', $hostels, null, ['class' => 'form-control']) !!}
</div>

<!-- Month Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('month_id', 'Month Id:') !!}
    {!! Form::select('month_id', $months, null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('hostelMonths.index') !!}" class="btn btn-default">Cancel</a>
</div>
