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
    
{{-- Create New Admin & Deleted Admins Button --}}
@if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->role == 'superadmin')
<div class="mb-3 d-flex">
    <a href="{{ route('admins.create') }}" class="btn btn-primary mr-2">Create New Admin</a>
    <a href="{{ route('admins.deleted') }}" class="btn btn-secondary">Deleted Admins</a>
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
                            <th>#</th> <!-- Changed column name to a counter -->
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($admins as $admin)
                        <tr>
                            <td>{{ $loop->iteration }}</td> <!-- Use $loop->iteration for the counter -->
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->role }}</td>
                            <td class="d-flex justify-content-center"> <!-- Align buttons in one line -->
                                <a href="{{ route('admins.show', $admin->id) }}" class="btn btn-sm btn-info mx-1">
                                    <i class="fas fa-eye"></i> <!-- Eye icon -->
                                </a>
                                @if((Auth::guard('admin')->check() && Auth::guard('admin')->user()->role == 'superadmin') || (Auth::guard('admin')->check() && $admin == $currentAdmin))
                                <a href="{{ route('admins.edit', $admin->id) }}" class="btn btn-sm btn-warning mx-1">
                                    <i class="fas fa-pencil-alt"></i> <!-- Pencil icon -->
                                </a>
                                @endif
                                @if((Auth::guard('admin')->check() && Auth::guard('admin')->user()->role == 'superadmin'))
                                <form id="delete-form-{{ $admin->id }}" action="{{ route('admins.destroy', $admin->id) }}" method="POST" style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button type="button" class="btn btn-sm btn-danger mx-1" onclick="confirmDelete({{ $admin->id }})">
                                    <i class="fas fa-trash"></i> <!-- Trash can icon -->
                                </button>
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