<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $hostel->id !!}</p>
</div>

<!-- Name Hostel Field -->
<div class="form-group">
    {!! Form::label('name_hostel', 'Name Hostel:') !!}
    <p>{!! $hostel->name_hostel !!}</p>
</div>

<!-- Name Hostel Field -->
<div class="form-group">
    {!! Form::label('avatar', 'Avatar:') !!}
    {!! HTML::image($hostel->avatar, 'avatar') !!}}
    <p>{!! $hostel->avatar !!}</p>
</div>

<!-- Name Host Field -->
<div class="form-group">
    {!! Form::label('name_host', 'Name Host:') !!}
    <p>{!! $hostel->name_host !!}</p>
</div>

<!-- City Id Field -->
<div class="form-group">
    {!! Form::label('city_id', 'City Id:') !!}
    <p>{!! $hostel->city_id !!}</p>
</div>

<!-- Main Picture Field -->
<div class="form-group">
    {!! Form::label('main_picture', 'Main Picture:') !!}
    <p>{!! $hostel->main_picture !!}</p>
</div>

<!-- Verified Field -->
<div class="form-group">
    {!! Form::label('verified', 'Verified:') !!}
    <p>{!! $hostel->verified !!}</p>
</div>

<!-- Start Stay Field -->
<div class="form-group">
    {!! Form::label('start_stay', 'Start Stay:') !!}
    <p>{!! $hostel->start_stay !!}</p>
</div>

<!-- End Stay Field -->
<div class="form-group">
    {!! Form::label('end_stay', 'End Stay:') !!}
    <p>{!! $hostel->end_stay !!}</p>
</div>

<!-- Travelers Reciebed Field -->
<div class="form-group">
    {!! Form::label('travelers_reciebed', 'Travelers Reciebed:') !!}
    <p>{!! $hostel->travelers_reciebed !!}</p>
</div>

<!-- Calification Field -->
<div class="form-group">
    {!! Form::label('calification', 'Calification:') !!}
    <p>{!! $hostel->calification !!}</p>
</div>

<!-- Web Field -->
<div class="form-group">
    {!! Form::label('web', 'Web:') !!}
    <p>{!! $hostel->web !!}</p>
</div>

<!-- Web Field -->
<div class="form-group">
    {!! Form::label('phone', 'Phone:') !!}
    <p>{!! $hostel->phone !!}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{!! $hostel->description !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $hostel->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $hostel->updated_at !!}</p>
</div>

