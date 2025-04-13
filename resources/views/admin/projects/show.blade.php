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
                        @foreach ($project->images as $image)
                            @php
                                $imagePath = $image->image
                                ? (Str::startsWith($image->image, ['http://', 'https://']) ? $image->image : asset($image->image))
                                : asset('assets/img/blog/blog-hero-2.webp');
                            @endphp
                            <img src="{{ $imagePath }}" alt="{{ $project->title }}" style="width: 100px; height: auto; margin-right: 5px;">
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <th>Likes Count</th>
                    <td>{{ $project->likes->count() }}</td>
                </tr>
                <tr>
                    <th>Comments Count</th>
                    <td>{{ $project->comments->count() }}</td>
                </tr>
                <tr>
                    <th>Author (User ID)</th>
                    <td>{{ $project->user->name ?? 'Unknown' }} (ID: {{ $project->user_id }})</td>
                </tr>
                <tr>
                    <th>Category ID</th>
                    <td>{{ $project->category->name ?? 'Unknown' }} (ID: {{ $project->category_id }})</td>
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
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Comments ({{ $project->comments->count() }})</h6>
            <button class="btn btn-sm btn-primary" data-toggle="collapse" data-target="#commentsCollapse">
                Toggle Comments
            </button>
        </div>
        <div class="card-body collapse show" id="commentsCollapse">
            @if($project->comments->count() > 0)
            <div class="list-group">
                @foreach($project->comments as $comment)
                <div class="list-group-item mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $comment->user->name ?? 'Unknown User' }}</strong>
                            <small class="text-muted ml-2">{{ $comment->created_at->diffForHumans() }}</small>
                        </div>
                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sm btn-danger mx-1" onclick="confirmDelete({{ $comment->id }})">
                                <i class="fas fa-trash"></i> <!-- Trash can icon -->
                            </button>
                        </form>
                    </div>
                    <p class="mt-2 mb-0">{{ $comment->content }}</p>
                </div>
                @endforeach
            </div>
            @else
            <div class="alert alert-info">No comments yet for this project.</div>
            @endif
        </div>
    </div>
    <div class="mt-3">
        <form id="delete-form-{{ $project->id }}" action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
        </form>
        <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $project->id }})">Delete Project</button>
        <a href="{{ route('projects.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</div>
@endsection