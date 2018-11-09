{!! Form::hidden('id', null, []) !!}

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
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

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>

<!-- Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone', 'Phone:') !!}
    {!! Form::number('phone', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Country Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('country_id', 'Country Id:') !!}
    {!! Form::select('country_id', $countries, null, ['class' => 'form-control']) !!}
</div>

<!-- City Field -->
<div class="form-group col-sm-6">
    {!! Form::label('city', 'City:') !!}
    {!! Form::select('city_id', $cities, null, ['class' => 'form-control']) !!}
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

<!-- Language native Field -->
<div class="form-group col-sm-12">
    {!! Form::label('native_language', 'Lenguaje Nativo:') !!}
    {!! Form::select('native_language', $languages, null, ['class' => 'form-control']) !!}
</div>

<!-- Language Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('language_id', 'Language Id 1:') !!}
    {!! Form::select('language_id', $languages, null, ['class' => 'form-control']) !!}
</div>

<!-- Language Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('language_id', 'Language Id 2:') !!}
    {!! Form::select('language2_id', $languages, null, ['class' => 'form-control']) !!}
</div>

<!-- Language Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('language_id', 'Language Id 3:') !!}
    {!! Form::select('language3_id', $languages, null, ['class' => 'form-control']) !!}
</div>

<!-- Language Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('language_id', 'Language Id 4:') !!}
    {!! Form::select('language4_id', $languages, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
    <hr>
</div>

<!-- facebook Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('facebook', 'Facebook:') !!}
    {!! Form::text('facebook', null, ['class' => 'form-control']) !!}
</div>

<!-- facebook Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('vimeo', 'Vimeo:') !!}
    {!! Form::text('vimeo', null, ['class' => 'form-control']) !!}
</div>

<!-- youtube Id Field -->
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

<!-- about_me Field -->
<div class="form-group col-sm-12">
    {!! Form::label('about_me', 'about me:') !!}
    {!! Form::textArea('about_me', null, ['class' => 'form-control','rows'=> "2"]) !!}
</div>

<!-- experience Field -->
<div class="form-group col-sm-12">
    {!! Form::label('experience', 'experience:') !!}
    {!! Form::textArea('experience', null, ['class' => 'form-control','rows'=> "5"]) !!}
</div>

<div class="form-group col-sm-12">
    <hr>
</div>

<!-- fecha de compra Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('payment_at', 'Fecha de compra:') !!}
    {!! Form::date('payment_at', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('is_premium', 'Premium:') !!}
    {!! Form::select('is_premium', $is_premium,null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('travelers.index') !!}" class="btn btn-default">Cancel</a>
</div>
