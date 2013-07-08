@extends('admin.master')

@section('content')

<h4>Page Form</h4>

<hr>

{{ $form_open }}
    <fieldset>
        <label>Page Title</label>
        {{ Form::text('page_title', NULL, array('style'=>'width: 100%;')) }}

        <label>Page Content</label>
        {{ Form::textarea('page_content', NULL, array('style'=>'width: 100%; height: 300px;')) }}

        <div class="control-group">
            <div class="controls">
                {{ Form::submit('Submit') }}
        </div>
        
    </fieldset>
{{ Form::close() }}

@stop