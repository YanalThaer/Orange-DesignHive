{{-- filepath: c:\Users\Abdal\OneDrive\Desktop\Orange-DesignHive\resources\views\admin\categories\edit.blade.php --}}
@extends('layouts.admin')
@section('title', 'DesignHive | Edit Category')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Category</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Category Information</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}" placeholder="Enter category name" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter category description">{{ old('description', $category->description) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="image">Image URL</label>
                    <input type="text" class="form-control" id="image" name="image" value="{{ old('image', $category->image) }}" placeholder="Enter image URL">
                </div>
                @if($category->image)
                    <div class="mt-2">
                        <img src="{{ $category->image }}" alt="{{ $category->name }}" style="width: 200px; height: auto;">
                    </div>
                @endif
                <button type="submit" class="btn btn-primary">Update Category</button>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>

@endsection