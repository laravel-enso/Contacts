<div class="col-sm-12 col-md-6">
    <div class="form-group{{ $errors->has('owner_id') ? ' has-error' : '' }}">
        {!! Form::label('owner_id', __("Entity")) !!}
        <small class="text-danger" style="float:right;">
            {{ $errors->first('owner_id') }}
        </small>
        <vue-select source="/administration/owners/getOptionsList"
                    name="owner_id"
                    selected="{{ $contactPerson->owner_id or 0 }}"
                    >
        </vue-select>
    </div>
</div>
<div class="col-sm-12 col-md-6">
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        {!! Form::label('name', __("Name")) !!}
        <small class="text-danger" style="float:right;">
            {{ $errors->first('name') }}
        </small>
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => __("Please Fill")]) !!}
    </div>
</div>
<div class="col-sm-12 col-md-6">
    <div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
        {!! Form::label('telephone', __("Telephone")) !!}
        <small class="text-danger" style="float:right;">
            {{ $errors->first('telephone') }}
        </small>
        {!! Form::text('telephone', null, ['class' => 'form-control', 'placeholder' => __("Please Fill")]) !!}
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