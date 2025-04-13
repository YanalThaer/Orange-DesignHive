@extends('layouts.admin')
@section('title', 'DesignHive | Show Deleted Admin')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Deleted Admin Details</h1>

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
                    <th>Deleted At</th>
                    <td>{{ $admin->deleted_at }}</td>
                </tr>
            </table>
        </div>
    </div>

    {{-- Actions --}}
    <div class="mt-3">
        <form action="{{ route('admins.restore', $admin->id) }}" method="POST" style="display:inline-block;">
            @csrf
            <button type="submit" class="btn btn-success">Restore</button>
        </form>
        <a href="{{ route('admins.deleted') }}" class="btn btn-secondary">Back to Deleted Admins</a>
        <a href="{{ route('admins.index') }}" class="btn btn-primary">Back to All Admins</a>
    </div>
</div>

@endsection