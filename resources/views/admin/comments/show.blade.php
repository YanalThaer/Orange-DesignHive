@extends('layouts.admin')
@section('title', 'DesignHive | Comment Details')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Comment Details</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Comment Information</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <td>{{ $comment->id }}</td>
                </tr>
                <tr>
                    <th>Comment Author</th>
                    <td>
                        {{ $comment->user->name ?? 'Unknown' }} with:( {{ $comment->user_id }} ) ID.
                    </td>
                </tr>
                <tr>
                    <th>Project ID</th>
                    <td>
                        @php
                        $projectTitle = $projects->firstWhere('id', $comment->project_id)?->title;
                        @endphp
                        {{ $projectTitle ?? 'No Project' }}
                    </td>
                </tr>
                <tr>
                    <th>Content</th>
                    <td>{{ $comment->content }}</td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ $comment->created_at }}</td>
                </tr>
                <tr>
                    <th>Updated At</th>
                    <td>{{ $comment->updated_at }}</td>
                </tr>
            </table>
        </div>
    </div>

    {{-- Actions --}}
    <div class="mt-3">
        <form id="delete-form-{{ $comment->id }}" action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
        </form>
        <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $comment->id }})">Delete</button>
        <a href="{{ route('comments.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</div>

@endsection