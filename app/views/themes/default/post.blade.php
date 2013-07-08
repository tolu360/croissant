@extends('themes.default.master')

@section('content')

<div class="post">

    <h2>{{ $post->post_title }}</h2>

    {{ $post->parsed_content }}

</div>

@stop