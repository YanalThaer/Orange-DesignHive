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
            <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}" placeholder="Enter category name" required>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control-file" id="image" name="image" required>
                </div>
                @php
                $image = $category->image;
                $imagePath = $image
                ? (Str::startsWith($image, ['http://', 'https://']) ? $image : asset($image))
                : asset('assets/img/blog/blog-hero-2.webp');
                @endphp
                @if($imagePath)
                    <div class="mt-2">
                        <img src="{{ $imagePath }}" alt="{{ $category->name }}" style="width: 200px; height: auto;">
                    </div>
                @endif
                <button type="submit" class="btn btn-primary">Update Category</button>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>

@endsection