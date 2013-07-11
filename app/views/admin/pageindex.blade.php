@extends('admin.master')

@section('content')

<div class="pull-left">
<h4>Pages</h4>
</div>

<div class="pull-right">
    <a href="{{ url('admin/page/create') }}" class="btn btn-small" style="margin-top: 10px;"><i class="icon-plus-sign"></i> New</a>
</div>

<div class="clearfix"></div>

<hr>

<table class="table table-striped table-condensed">
    <thead>
        <tr>
            <th style="width: 15%;">Created</th>
            <th style="width: 15%;">Updated</th>
            <th style="width: 55%;">Title</th>
            <th style="width: 15%;">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pages as $page)
        <tr>
            <td>{{ $page->created_at->format('m/d/Y') }}</td>
            <td>{{ $page->updated_at->format('m/d/Y') }}</td>
            <td>{{ $page->page_title }}</td>
            <td>
                <div class="btn-group">
                    <a href="{{ url('admin/page/edit/' . $page->id) }}" class="btn btn-mini"><i class="icon-pencil"></i> Edit</a>
                    <a href="{{ url('admin/page/delete/' . $page->id) }}" class="btn btn-mini"><i class="icon-trash"></i> Delete</a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $pages->links() }}

@stop