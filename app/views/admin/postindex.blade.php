@extends('admin.master')

@section('content')

<div class="pull-left">
    <h4>Posts</h4>
</div>

<div class="pull-right">
    <a href="{{ url('admin/post/create') }}" class="btn btn-small" style="margin-top: 10px;"><i class="icon-plus-sign"></i> New</a>
</div>

<div class="clearfix"></div>

<hr>

<table class="table table-striped table-condensed">
    <thead>
        <tr>
            <th style="width: 20%;">Date</th>
            <th style="width: 60%;">Title</th>
            <th style="width: 10%; text-align: center;">Published</th>
            <th style="width: 10%;">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)
        <tr>
            <td>{{ $post->created_at->toDateTimeString() }}</td>
            <td>{{ $post->post_title }}</td>
            <td style="text-align: center;">{{ $post->is_published }}</td>
            <td>
                <div class="btn-group">
                    <a href="{{ url('admin/post/edit/' . $post->id) }}" class="btn btn-mini"><i class="icon-pencil"></i> Edit</a>
                    <a href="{{ url('admin/post/delete/' . $post->id) }}" class="btn btn-mini"><i class="icon-trash"></i> Delete</a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $posts->links() }}

@stop