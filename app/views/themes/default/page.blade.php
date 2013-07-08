@extends('themes.default.master')

@section('content')

<div class="post">

    <h2>{{ $page->page_title }}</h2>

    {{ $page->parsed_content }}

</div>

@stop