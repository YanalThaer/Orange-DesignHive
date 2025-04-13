@extends('layouts.admin')
@section('title', 'DesignHive | Admin Show Admin')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-0 text-gray-800">Admin Details</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Admin Information</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <td>{{ $admin->id }}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ $admin->name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $admin->email }}</td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td>{{ $admin->role }}</td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ $admin->created_at }}</td>
                </tr>
                <tr>
                    <th>Updated At</th>
                    <td>{{ $admin->updated_at }}</td>
                </tr>
            </table>
        </div>
    </div>

    {{-- Tags Added by Admin --}}
    <div class="card shadow mb-4 mt-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tags Added by {{ $admin->name }}</h6>
        </div>
        <div class="card-body">
            @if($admin->tags->isNotEmpty())
                <ul class="list-group">
                    @foreach($admin->tags as $tag)
                        <li class="list-group-item">{{ $tag->name }}</li>
                    @endforeach
                </ul>
            @else
                <p>No tags added by this admin.</p>
            @endif
        </div>
    </div>

    {{-- Categories Added by Admin --}}
    <div class="card shadow mb-4 mt-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Categories Added by {{ $admin->name }}</h6>
        </div>
        <div class="card-body">
            @if($admin->categories->isNotEmpty())
                <ul class="list-group">
                    @foreach($admin->categories as $category)
                        <li class="list-group-item">{{ $category->name }}</li>
                    @endforeach
                </ul>
            @else
                <p>No categories added by this admin.</p>
            @endif
        </div>
    </div>

    {{-- Actions --}}
    <div class="mt-3">
        <a href="{{ route('admins.edit', $admin->id) }}" class="btn btn-warning">Edit</a>
        <form id="delete-form-{{ $admin->id }}" action="{{ route('admins.destroy', $admin->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
        </form>
        <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $admin->id }})">Delete</button>
        <a href="{{ route('admins.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</div>

@endsection