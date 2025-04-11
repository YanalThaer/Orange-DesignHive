@extends('layouts.admin')
@section('title', 'DesignHive | Category Details')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Category Details</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Category Information</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <td>{{ $category->id }}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ $category->name }}</td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td>{{ $category->description }}</td>
                </tr>
                <tr>
                    <th>Image</th>
                    <td>
                        @if($category->image)
                            <img src="{{ $category->image }}" alt="{{ $category->name }}" style="width: 200px; height: auto;">
                        @else
                            No Image
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Created By</th>
                    <td>{{ $category->admin->name ?? 'Unknown' }}</td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ $category->created_at }}</td>
                </tr>
                <tr>
                    <th>Updated At</th>
                    <td>{{ $category->updated_at }}</td>
                </tr>
            </table>
        </div>
    </div>

    {{-- Actions --}}
    <div class="mt-3">
        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary">Edit</a>
        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
        </form>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</div>

@endsection