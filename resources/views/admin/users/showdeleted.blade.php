@extends('layouts.admin')
@section('title', 'DesignHive | Show Deleted User')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Deleted User Details</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User Information</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <td>{{ $user->id }}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>Deleted At</th>
                    <td>{{ $user->deleted_at }}</td>
                </tr>
            </table>
        </div>
    </div>

    {{-- Actions --}}
    <div class="mt-3">
        <form action="{{ route('users.restore', $user->id) }}" method="POST" style="display:inline-block;">
            @csrf
            <button type="submit" class="btn btn-success">Restore</button>
        </form>
        <a href="{{ route('users.deleted') }}" class="btn btn-secondary">Back to Deleted Users</a>
        <a href="{{ route('users.index') }}" class="btn btn-primary">Back to All Users</a>
    </div>
</div>

@endsection