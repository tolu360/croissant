@extends('themes.default.master')

@section('content')

<hr>

<div class="jumbotron">
    <p class="lead">I like building things on the web, primarily using PHP, a 
        little bit of javascript and other fun stuff here and there.</p>
</div>

<hr>

<h4 style="text-align: center;">Most Recent Posts</h4>

@foreach ($posts as $post)
<p><a href="{{ URL::to('post/' . $post->post_url_title) }}">{{ $post->post_title }}</a><span class="pull-right">{{ $post->created_at->format('D F j, Y') }}</span></p>
@endforeach

@stop

