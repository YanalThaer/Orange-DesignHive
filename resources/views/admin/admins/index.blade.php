@extends('layouts.admin')
@section('title', 'DesignHive | Admin Admins')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-0 text-gray-800">Admins</h1>

    {{-- Display success message --}}
    @if(session('success'))
        <div id="success-message" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    {{-- Create New Admin Button --}}
    @if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->role == 'superadmin')
    <div class="mb-3">
        <a href="{{ route('admins.create') }}" class="btn btn-primary">Create New Admin</a>
    </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Admins List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($admins as $admin)
                        <tr>
                            <td>{{ $admin->id }}</td>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->role }}</td>
                            <td>
                                <a href="{{ route('admins.show', $admin->id) }}" class="btn btn-sm btn-info">Show</a>
                                {{-- <a href="{{ route('admins.edit', $admin->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('admins.destroy', $admin->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this admin?')">Delete</button>
                                </form> --}}
                                @if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->role == 'superadmin')
                                <a href="{{ route('admins.edit', $admin->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('admins.destroy', $admin->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this admin?')">Delete</button>
                                </form>
                            @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection