{{-- filepath: c:\Users\Abdal\OneDrive\Desktop\Orange-DesignHive\resources\views\admin\categories\create.blade.php --}}
@extends('layouts.admin')
@section('title', 'DesignHive | Admin Add Category')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Add New Category</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Category Information</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter category name" required>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control-file" id="image" name="image" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Category</button>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>

@endsection