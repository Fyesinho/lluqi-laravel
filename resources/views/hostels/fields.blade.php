<div class="form-group col-sm-12">
    {!! Form::label('user_id', 'Usuario:') !!}
    <select class="form-control" id="user_id" name="user_id">
        <option value="0" @if(!isset($hostel)) selected @endif> Sin asignar</option>

        @foreach($users as $id => $user)
            <option value="{{$id}}" @if(isset($hostel) && $id == $hostel->user_id) selected @endif >{{ $user }}</option>
        @endforeach
    </select>
</div>


<!-- Name Hostel Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name_hostel', 'Name Hostel:') !!}
    {!! Form::text('name_hostel', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Host Field -->
<div class="form-group col-sm-6">
    {!! Form::label('avatar', 'Avatar:') !!}
    {!! Form::text('avatar', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Host Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name_host', 'Name Host:') !!}
    {!! Form::text('name_host', null, ['class' => 'form-control']) !!}
</div>

<!-- City Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('city_id', 'City Id:') !!}
    {!! Form::select('city_id', $cities, null, ['class' => 'form-control']) !!}
</div>

<!-- Main Picture Field -->
<div class="form-group col-sm-6">
    {!! Form::label('main_picture', 'Main Picture:') !!}
    {!! Form::text('main_picture', null, ['class' => 'form-control']) !!}
</div>

<!-- Verified Field -->
<div class="form-group col-sm-6">
    {!! Form::label('verified', 'Verified:') !!}
    {!! Form::text('verified', null, ['class' => 'form-control']) !!}
</div>

<!-- Start Stay Field -->
<div class="form-group col-sm-6">
    {!! Form::label('start_stay', 'Start Stay:') !!}
    {!! Form::text('start_stay', null, ['class' => 'form-control']) !!}
</div>

<!-- End Stay Field -->
<div class="form-group col-sm-6">
    {!! Form::label('end_stay', 'End Stay:') !!}
    {!! Form::text('end_stay', null, ['class' => 'form-control']) !!}
</div>

<!-- Travelers Reciebed Field -->
<div class="form-group col-sm-6">
    {!! Form::label('travelers_reciebed', 'Travelers Reciebed:') !!}
    {!! Form::text('travelers_reciebed', null, ['class' => 'form-control']) !!}
</div>

<!-- Calification Field -->
<div class="form-group col-sm-6">
    {!! Form::label('calification', 'Calification:') !!}
    {!! Form::text('calification', null, ['class' => 'form-control']) !!}
</div>

<!-- Web Field -->
<div class="form-group col-sm-6">
    {!! Form::label('web', 'Web:') !!}
    {!! Form::text('web', null, ['class' => 'form-control']) !!}
</div>

<!-- Web Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone', 'Phone:') !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => '4']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('hostels.index') !!}" class="btn btn-default">Cancel</a>
</div>
