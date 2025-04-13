@extends('layouts.admin')
@section('title', 'DesignHive | Deleted Admins')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Deleted Admins</h1>

    {{-- Display success message --}}
    @if(session('success'))
        <div id="success-message" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Deleted Admins List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($admins as $admin)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->role }}</td>
                            <td class="d-flex justify-content-center">
                                <a href="{{ route('admins.showdeleted', $admin->id) }}" class="btn btn-sm btn-info mx-1">
                                    <i class="fas fa-eye"></i> Show
                                </a>
                                <form action="{{ route('admins.restore', $admin->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success mx-1">
                                        <i class="fas fa-undo"></i> Restore
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- Actions --}}
    <div class="mt-3">
        <a href="{{ route('admins.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</div>

@endsection