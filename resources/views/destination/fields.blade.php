<div class="col-xs-12">
    <div class="form-group col-sm-12">
        {!! Form::label('city', 'ciudad:') !!}
        {!! Form::select('city_id', $cities ,null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('destination.index') !!}" class="btn btn-default">Cancel</a>
</div>
