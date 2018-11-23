<!-- City Field -->
<div class="form-group col-sm-6">
    {!! Form::label('activity', 'Activity:') !!}
    {!! Form::text('activity', null, ['class' => 'form-control']) !!}
</div>

<!-- City Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Tipo:') !!}
    {!! Form::select('type', $types, null, ['class' => 'form-control']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('needActivities.index') !!}" class="btn btn-default">Cancel</a>
</div>
