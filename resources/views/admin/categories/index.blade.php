@extends('layouts.admin')
@section('title', 'DesignHive | Admin Categories')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-0 text-gray-800">Categories</h1>

    {{-- Display success message --}}
    @if(session('success'))
        <div id="success-message" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    {{-- Create New Category Button --}}
    <div class="mb-3">
        <a href="{{ route('categories.create') }}" class="btn btn-primary">Create New Category</a>
        <a href="{{ route('categories.deleted') }}" class="btn btn-secondary">Deleted Categories</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Categories List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th> <!-- Changed column name to a counter -->
                            <th>Name</th>
                            <th>Created By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td> <!-- Use $loop->iteration for the counter -->
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->admin->name ?? 'Unknown' }}</td> 
                            <td class="d-flex justify-content-center"> <!-- Align buttons in one line -->
                                <a href="{{ route('categories.show', $category->id) }}" class="btn btn-sm btn-info mx-1">
                                    <i class="fas fa-eye"></i> <!-- Eye icon -->
                                </a>
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning mx-1">
                                    <i class="fas fa-pencil-alt"></i> <!-- Pencil icon -->
                                </a>
                                <form id="delete-form-{{ $category->id }}" action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button type="button" class="btn btn-sm btn-danger mx-1" onclick="confirmDelete({{ $category->id }})">
                                    <i class="fas fa-trash"></i> <!-- Trash can icon -->
                                </button>
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