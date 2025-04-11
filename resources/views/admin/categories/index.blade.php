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
                            <th>ID</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Created By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                @if($category->image)
                                    <img src="{{ $category->image}}" alt="{{ $category->name }}" style="width: 100px; height: auto;">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td>{{ $category->description }}</td>
                            <td>{{ $category->admin->name ?? 'Unknown' }}</td> 
                            <td>
                                <a href="{{ route('categories.show', $category->id) }}" class="btn btn-sm btn-info m-1 fixed-width-btn">Show</a>
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-primary m-1 fixed-width-btn">Edit</a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger m-1 fixed-width-btn" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                                </form>
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