<div class="row" style="margin: auto">
    <!-- Avatar Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('image', 'Imagen:') !!}
        @if(isset($testimonial))
            @if(isset($testimonial->getMedia('image')[0]))
                <img src="/{{ $testimonial->getMedia('image')[0]->disk}}/{{ $testimonial->getMedia('image')[0]->id}}/{{ $testimonial->getMedia('image')[0]->file_name}}" style="width: 100px; display: block; margin: 5px auto">
            @endif
        @endif
        {!! Form::file('image', ['class' => 'form-control', "accept" => 'image/*']) !!}
    </div>

    <!-- Email Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('description', 'Description:') !!}
        {!! Form::textarea('description', null, ['class' => 'form-control', 'required', 'rows'=>'5']) !!}
    </div>

</div>

<div class="form-group col-sm-12">
    {!! Form::label('user', 'Usuario:') !!}
    {!! Form::text('user', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('travelers.index') !!}" class="btn btn-default">Cancel</a>
</div>
