@extends('layouts.admin')
@section('title', 'DesignHive | Project Details')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Project Details</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Project Information</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <td>{{ $project->id }}</td>
                </tr>
                <tr>
                    <th>Title</th>
                    <td>{{ $project->title }}</td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td>{{ $project->description }}</td>
                </tr>
                <tr>
                    <th>Image</th>
                    <td>
                        @if($project->image)
                            <img src="{{ $project->image }}" alt="{{ $project->title }}" style="width: 200px; height: auto;">
                        @else
                            No Image
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Format</th>
                    <td>{{ $project->format }}</td>
                </tr>
                <tr>
                    <th>Likes Count</th>
                    <td>{{ $project->likes_count }}</td>
                </tr>
                <tr>
                    <th>Comments Count</th>
                    <td>{{ $project->comments_count }}</td>
                </tr>
                <tr>
                    <th>Author (User ID)</th>
                    <td>{{ $project->user->name ?? 'Unknown' }} (ID: {{ $project->user_id }})</td>
                </tr>
                <tr>
                    <th>Category ID</th>
                    <td>{{ $project->category_id }}</td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ $project->created_at }}</td>
                </tr>
                <tr>
                    <th>Updated At</th>
                    <td>{{ $project->updated_at }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="mt-3">
        <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this project?')">Delete</button>
        </form>
        <a href="{{ route('projects.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</div>

@endsection