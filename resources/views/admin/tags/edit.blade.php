{{-- filepath: c:\Users\Abdal\OneDrive\Desktop\Orange-DesignHive\resources\views\admin\categories\edit.blade.php --}}
@extends('layouts.admin')
@section('title', 'DesignHive | Edit Tag')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Tag</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Tag Information</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('tags.update', $tag->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('tag', $tag->name) }}" placeholder="Enter category name" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Tag</button>
                <a href="{{ route('tags.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>

@endsection