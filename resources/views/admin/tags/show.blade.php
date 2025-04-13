@extends('layouts.admin')
@section('title', 'DesignHive | Tag Details')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Tag Details</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tag Information</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <td>{{ $tag->id }}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ $tag->name }}</td>
                </tr>
                <tr>
                    <th>Created By</th>
                    <td>{{ $tag->admin->name ?? 'Unknown' }}</td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ $tag->created_at }}</td>
                </tr>
                <tr>
                    <th>Updated At</th>
                    <td>{{ $tag->updated_at }}</td>
                </tr>
            </table>
        </div>
    </div>

    {{-- Actions --}}
    <div class="mt-3">
        <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-warning">Edit</a>
        <form id="delete-form-{{ $tag->id }}" action="{{ route('tags.destroy', $tag->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
        </form>
        <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $tag->id }})">Delete</button>
        <a href="{{ route('tags.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</div>

@endsection