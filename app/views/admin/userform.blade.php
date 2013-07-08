@extends('admin.master')

@section('content')

<pre>{{ print_r($errors) }}</pre>

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