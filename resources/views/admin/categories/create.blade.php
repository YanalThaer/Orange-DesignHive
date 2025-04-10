@extends('layouts.admin')
@section('title', 'DesignHive | Admin Add Category')
@section('content')

<div class="container-fluid">
    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        @method('POST')
        <div class="form-group"></div>
            <label for="name">Category Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter category name" required>
    </form>
</div>
@endsection