@extends('layouts.admin')
@section('title', 'DesignHive | Admin Show Admin')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-0 text-gray-800">Admin Details</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Admin Information</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <td>{{ $admin->id }}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ $admin->name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $admin->email }}</td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td>{{ $admin->role }}</td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ $admin->created_at }}</td>
                </tr>
                <tr>
                    <th>Updated At</th>
                    <td>{{ $admin->updated_at }}</td>
                </tr>
            </table>
        </div>
    </div>

    {{-- Actions --}}
    <div class="mt-3">
        <a href="{{ route('admins.edit', $admin->id) }}" class="btn btn-primary">Edit</a>
        <form action="{{ route('admins.destroy', $admin->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this admin?')">Delete</button>
        </form>
        <a href="{{ route('admins.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</div>
@endsection