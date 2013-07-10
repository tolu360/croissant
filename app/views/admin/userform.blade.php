@extends('admin.master')

@section('content')

<h4>User Form</h4>

<hr>

@foreach ($errors->all() as $error)
<div class="alert alert-error">{{ $error }}</div>
@endforeach

{{ $form_open }}
    <fieldset>
        <label>Username</label>
        {{ Form::text('username', NULL, array('class'=>'input-xxlarge')) }}
        
        <label>Password</label>
        {{ Form::password('password', NULL, array('class'=>'input-xxlarge')) }}
        
        <label>Password (Verification)</label>
        {{ Form::password('password_verification', NULL, array('class'=>'input-xxlarge')) }}

        <div class="control-group">
            <div class="controls">
                {{ Form::submit('Submit') }}
        </div>
        
    </fieldset>
{{ Form::close() }}

@stop