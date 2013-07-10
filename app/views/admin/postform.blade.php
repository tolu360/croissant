@extends('admin.master')

@section('content')

<h4>Post Form</h4>

<hr>

@foreach ($errors->all() as $error)
<div class="alert alert-error">{{ $error }}</div>
@endforeach

{{ $form_open }}
    <fieldset>
        <label>Post Title</label>
        {{ Form::text('post_title', NULL, array('style'=>'width: 100%;')) }}

        <label>Post Content</label>
        {{ Form::textarea('post_content', NULL, array('style'=>'width: 100%; height: 300px;', 'data-widearea'=>'enable')) }}
        
        <label>Published</label>
        {{ Form::select('post_published', array('1' => 'Yes', '0' => 'No')); }}

        <div class="control-group">
            <div class="controls">
                {{ Form::submit('Submit') }}
        </div>
        
    </fieldset>
{{ Form::close() }}

<script type="text/javascript">wideArea();</script>

@stop