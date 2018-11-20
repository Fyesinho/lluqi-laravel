{!! Form::hidden('id', null, []) !!}

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="row" style="margin: auto">
    <!-- Avatar Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('avatar', 'Avatar:') !!}
        @if(isset($traveler))
            @if(isset($traveler->getMedia('avatar')[0]))
                <img src="/{{ $traveler->getMedia('avatar')[0]->disk}}/{{ $traveler->getMedia('avatar')[0]->id}}/{{ $traveler->getMedia('avatar')[0]->file_name}}" style="width: 100px; display: block; margin: 5px auto">
            @endif
        @endif
        {!! Form::file('avatar', ['class' => 'form-control', "accept" => 'image/*']) !!}
    </div>

    <!-- Description Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('description', 'Descripción:') !!}
        {!! Form::textArea('description', null, ['class' => 'form-control', 'rows'=> "3"]) !!}
    </div>
</div>

<!-- Gender Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gender', 'Gender:') !!}
        {!! Form::select('gender_id', $genders, null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Birthday Field -->
<div class="form-group col-sm-6">
    {!! Form::label('birthday', 'Birthday:') !!}
    {!! Form::date('birthday', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone', 'Phone:') !!}
    {!! Form::number('phone', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>

<!-- Role Field -->
<div class="form-group col-sm-12">
    {!! Form::label('role', 'Rol:') !!}
    {!! Form::select('role', $roles, null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('travelers.index') !!}" class="btn btn-default">Cancel</a>
</div>
