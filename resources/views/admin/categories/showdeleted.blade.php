@extends('layouts.admin')
@section('title', 'DesignHive | Show Deleted Category')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Deleted Category Details</h1>

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
                    <th>Created By</th>
                    <td>{{ $category->admin->name ?? 'Unknown' }}</td>
                </tr>
                <tr>
                    <th>Deleted At</th>
                    <td>{{ $category->deleted_at }}</td>
                </tr>
            </table>
            
            @if($category->image)
            <div class="mt-3">
                <h6>Category Image:</h6>
                <img src="{{ $category->image }}" alt="{{ $category->name }}" style="max-width: 300px;">
            </div>
            @endif
        </div>
    </div>

    <div class="mt-3">
        <form action="{{ route('categories.restore', $category) }}" method="POST" style="display:inline-block;">
            @csrf
            <button type="submit" class="btn btn-success">Restore Category</button>
        </form>
        <a href="{{ route('categories.deleted') }}" class="btn btn-secondary">Back to Deleted Categories</a>
        <a href="{{ route('categories.index') }}" class="btn btn-primary">Back to Active Categories</a>
    </div>
</div>

@endsection