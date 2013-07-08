@extends('admin.master')

@section('content')

<div class="pull-left">
    <h4>Users</h4>
</div>

<div class="pull-right">
    <a href="{{ url('admin/user/create') }}" class="btn btn-small" style="margin-top: 10px;"><i class="icon-plus-sign"></i> New</a>
</div>

<div class="clearfix"></div>

<hr>

<table class="table table-striped table-condensed">
    <thead>
        <tr>
            <th style="width: 85%;">Username</th>
            <th style="width: 15%;">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td><?php echo $user->username; ?></td>
            <td>
                <div class="btn-group">
                    <a href="{{ url('admin/user/edit/' . $user->id) }}" class="btn btn-mini"><i class="icon-pencil"></i> Edit</a>
                    <a href="{{ url('admin/user/delete/' . $user->id) }}" class="btn btn-mini"><i class="icon-trash"></i> Delete</a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $users->links() }}

@stop