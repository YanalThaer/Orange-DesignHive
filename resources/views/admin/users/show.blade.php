@extends('layouts.admin')
@section('title', 'DesignHive | User Details')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">User Details</h1>

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
                    <th>Email Verified At</th>
                    <td>{{ $user->email_verified_at ?? 'Not Verified' }}</td>
                </tr>
                <tr>
                    <th>Provider</th>
                    <td>{{ $user->provider ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Provider ID</th>
                    <td>{{ $user->provider_id ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ $user->created_at }}</td>
                </tr>
                <tr>
                    <th>Updated At</th>
                    <td>{{ $user->updated_at }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</div>

@endsection