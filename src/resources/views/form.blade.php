<div class="col-sm-12 col-md-6">
    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
        {!! Form::label('first_name', __("First Name")) !!}
        <small class="text-danger" style="float:right;">
            {{ $errors->first('first_name') }}
        </small>
        {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => __("Please Fill")]) !!}
    </div>
</div>
<div class="col-sm-12 col-md-6">
    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
        {!! Form::label('last_name', __("Last Name")) !!}
        <small class="text-danger" style="float:right;">
            {{ $errors->first('last_name') }}
        </small>
        {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => __("Please Fill")]) !!}
    </div>
</div>
<div class="col-sm-12 col-md-6">
    <div class="form-group{{ $errors->has('owner_id') ? ' has-error' : '' }}">
        {!! Form::label('owner_id', __("Entity")) !!}
        <small class="text-danger" style="float:right;">
            {{ $errors->first('owner_id') }}
        </small>
        <vue-select source="/administration/owners/getOptionsList"
            name="owner_id"
            selected="{{ request()->old('owner_id') ?: ($contact->owner_id or 0) }}">
        </vue-select>
    </div>
</div>
<div class="col-sm-12 col-md-6">
    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
        {!! Form::label('phone', __("Phone")) !!}
        <small class="text-danger" style="float:right;">
            {{ $errors->first('phone') }}
        </small>
        {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => __("Please Fill")]) !!}
    </div>
</div>
<div class="col-sm-12 col-md-6">
    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        {!! Form::label('email', __("Email")) !!}
        <small class="text-danger" style="float:right;">
            {{ $errors->first('email') }}
        </small>
        {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => __("Please Fill")]) !!}
    </div>
</div>
<div class="col-sm-6">
    <div class="form-group{{ $errors->has('is_active') ? ' has-error' : '' }}">
        {!! Form::label('is_active', __("Active")) !!}
        <small class="text-danger" style="float:right;">
            {{ $errors->first('is_active') }}
        </small>
        {!! Form::select('is_active', $statuses, null, ['class' => 'form-control select']) !!}
    </div>
</div>