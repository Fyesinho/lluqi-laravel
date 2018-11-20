{!! Form::hidden('id', null, []) !!}

<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="row" style="margin: auto">
    <div class="form-group col-sm-6">
        {!! Form::label('avatar', 'Avatar:') !!}
        @if(isset($traveler))
            @if(isset($traveler->getMedia('avatar')[0]))
                <img src="/{{ $traveler->getMedia('avatar')[0]->disk}}/{{ $traveler->getMedia('avatar')[0]->id}}/{{ $traveler->getMedia('avatar')[0]->file_name}}" style="width: 100px; display: block; margin: 5px auto">
            @endif
        @endif
        {!! Form::file('avatar', ['class' => 'form-control', "accept" => 'image/*']) !!}
    </div>

    <div class="form-group col-sm-6">
        {!! Form::label('description', 'Descripción:') !!}
        {!! Form::textArea('description', null, ['class' => 'form-control', 'rows'=> "3"]) !!}
    </div>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('gender', 'Gender:') !!}
    {!! Form::select('gender_id', $genders, null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('birthday', 'Birthday:') !!}
    {!! Form::date('birthday', null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('phone', 'Phone:') !!}
    {!! Form::number('phone', null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('country_id', 'Country Id:') !!}
    {!! Form::select('country_id', $countries, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('city', 'City:') !!}
    {!! Form::text('city', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
    <hr>
</div>

<div class="form-group col-sm-12">
    {!! Form::label('role', 'Rol:') !!}
    {!! Form::select('role', $roles, null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="form-group col-sm-12">
    <hr>
</div>

<div class="form-group col-sm-12">
    {!! Form::label('native_language', 'Lenguaje Nativo:') !!}
    {!! Form::select('native_language', $languages, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('language_id', 'Language Id 1:') !!}
    {!! Form::select('language_id', $languages, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('language_id', 'Language Id 2:') !!}
    {!! Form::select('language2_id', $languages, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('language_id', 'Language Id 3:') !!}
    {!! Form::select('language3_id', $languages, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('language_id', 'Language Id 4:') !!}
    {!! Form::select('language4_id', $languages, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
    <hr>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('facebook', 'Facebook:') !!}
    {!! Form::text('facebook', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('vimeo', 'Vimeo:') !!}
    {!! Form::text('vimeo', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('youtube', 'Youtube:') !!}
    {!! Form::text('youtube', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
    <hr>
</div>

<div class="form-group col-md-6">
    {!! Form::label('basic_help', 'basic help:') !!}
    {!! Form::select('basic_help', $activities, isset($traveler) ? $traveler->userBasicHelp : [], ['class' => 'form-control', 'multiple'=>'multiple', 'name' => "basic_help[]"]); !!}
</div>

<div class="form-group col-md-6">
    {!! Form::label('advanced_help', 'advanced help:') !!}
    {!! Form::select('advanced_help', $activities, isset($traveler) ? $traveler->userAdvancedHelp : [], ['class' => 'form-control', 'multiple'=>'multiple', 'name' => "advanced_help[]"]); !!}
</div>

<div class="form-group col-sm-12">
    <hr>
</div>

<div class="form-group col-sm-12">
    {!! Form::label('your_video', 'Mi video:') !!}
    {!! Form::text('your_video', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-12">
    {!! Form::label('about_me', 'about me:') !!}
    {!! Form::textArea('about_me', null, ['class' => 'form-control','rows'=> "2"]) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('experience', 'experience:') !!}
    {!! Form::textArea('experience', null, ['class' => 'form-control','rows'=> "5"]) !!}
</div>

<div class="form-group col-sm-12">
    <hr>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('payment_at', 'Fecha de compra:') !!}
    {!! Form::date('payment_at', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('is_premium', 'Premium:') !!}
    {!! Form::select('is_premium', $is_premium,null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('travelers.index') !!}" class="btn btn-default">Cancel</a>
</div>
