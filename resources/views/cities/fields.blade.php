<div class="col-xs-6">
    {!! Form::label('imagen', 'Imagen:') !!}
    @if(isset($city))
        @if(isset($city->getMedia('destinations')[0]))
            <img src="/{{ $city->getMedia('destinations')[0]->disk}}/{{ $city->getMedia('destinations')[0]->id}}/{{ $city->getMedia('destinations')[0]->file_name}}" style="width: 100px; display: block; margin: 5px auto">
        @endif
    @endif
    {!! Form::file('image', ['class' => 'form-control', "accept" => 'image/*']) !!}
</div>

<div class="col-xs-6">
    <!-- City Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('city', 'City:') !!}
        {!! Form::text('city', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Country Id Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('country_id', 'Country Id:') !!}
        {!! Form::select('country_id', $cities ,null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- Description Field -->
<div class="form-group col-sm-12">
    {!! Form::label('description', 'Descripción:') !!}
    {!! Form::textarea('description' ,null, ['class' => 'form-control', 'rows' => '6']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('cities.index') !!}" class="btn btn-default">Cancel</a>
</div>
