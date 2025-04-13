@extends('layouts.public')
@section('title', 'DesignHive | Edit Project')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .edit-project-card {
        max-width: 700px;
        margin: auto;
        background-color: #fff;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
    }

    .edit-project-card h2 {
        font-weight: bold;
        margin-bottom: 30px;
        color: #333;
    }

    .edit-project-card label {
        font-weight: 500;
        color: #444;
    }

    .edit-project-card input,
    .edit-project-card select,
    .edit-project-card textarea {
        border-radius: 12px;
        padding: 12px;
        border: 1px solid #ccc;
        transition: 0.3s;
    }

    .edit-project-card input:focus,
    .edit-project-card select:focus,
    .edit-project-card textarea:focus {
        border-color: #420363;
        box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.2);
    }

    .image-preview {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #f0f0f0;
        margin-bottom: 15px;
    }

    .form-icon {
        color: #420363;
        margin-right: 8px;
    }

    .btn-update {
        background-color: #420363;
        border: none;
        padding: 12px 30px;
        color: white;
        font-weight: 500;
        border-radius: 30px;
        transition: 0.3s;
    }

    .btn-update:hover {
        background-color: white;
        color: #420363;
        border: 2px solid #420363;
    }
</style>

<div class="container my-5">
    <div class="edit-project-card">
        <h2>Edit Your Project</h2>
        <form action="{{ route('update.project', $project->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="text-center">
                @foreach($project->images as $image)
                @php
                $imagePath = $image->image ?? 'assets/img/blog/blog-hero-2.webp';
                $imagePath = $imagePath ? (Str::startsWith($image, ['http://', 'https://']) ? $imagePath : asset($imagePath)) : asset('assets/img/blog/blog-hero-2.webp');
                @endphp
                <img src="{{ $imagePath }}" alt="Project Image" class="image-preview">
                @endforeach
            </div>
            <div class="mb-3">
                <label><i class="fas fa-heading form-icon"></i>Project Title</label>
                <input type="text" name="title" value="{{ $project->title }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label><i class="fas fa-tags form-icon"></i>Category</label>
                <select name="category_id" class="form-control" required>
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $project->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label><i class="fas fa-align-left form-icon"></i>Description</label>
                <textarea name="description" class="form-control" rows="4" required>{{ $project->description }}</textarea>
            </div>
            <div class="mb-4">
                <label><i class="fas fa-image form-icon"></i>Upload New Images</label>
                <input type="file" name="images[]" class="form-control mt-2" multiple>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-update"><i class="fas fa-save"></i> Update Project</button>
            </div>
        </form>
    </div>
</div>
@endsection