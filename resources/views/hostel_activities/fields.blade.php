<!-- Hostel Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('hostel_id', 'Hostel Id:') !!}
    {!! Form::select('hostel_id', $hostels , null, ['class' => 'form-control']) !!}
</div>

<!-- Activity Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('activity_id', 'Activity Id:') !!}
    {!! Form::select('activity_id', $activities, null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('hostelActivities.index') !!}" class="btn btn-default">Cancel</a>
</div>
