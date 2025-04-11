@extends('layouts.admin')
@section('title', 'DesignHive | Admin Edit Admin')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-0 text-gray-800">Edit Admin</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Admin Information</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admins.update', $admin->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $admin->name) }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $admin->email) }}" required>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" id="role" class="form-control" required>
                        <option value="Admin" {{ $admin->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                        <option value="superadmin" {{ $admin->role == 'Super Admin' ? 'selected' : '' }}>Super Admin</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('admins.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection