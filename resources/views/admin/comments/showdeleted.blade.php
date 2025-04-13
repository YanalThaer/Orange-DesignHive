@extends('layouts.admin')
@section('title', 'DesignHive | Show Deleted Comment')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Deleted Comment Details</h1>

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
                    <th>Author</th>
                    <td>{{ $comment->user->name ?? 'Unknown' }} (ID: {{ $comment->user_id }})</td>
                </tr>
                <tr>
                    <th>Project</th>
                    <td>{{ $comment->projects->title ?? 'Deleted Project' }} (ID: {{ $comment->project_id }})</td>
                </tr>
                <tr>
                    <th>Content</th>
                    <td>{{ $comment->content }}</td>
                </tr>
                <tr>
                    <th>Deleted At</th>
                    <td>{{ $comment->deleted_at }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="mt-3">
        <form action="{{ route('comments.restore', $comment) }}" method="POST" style="display:inline-block;">
            @csrf
            <button type="submit" class="btn btn-success">Restore Comment</button>
        </form>
        <a href="{{ route('comments.deleted') }}" class="btn btn-secondary">Back to Deleted Comments</a>
        <a href="{{ route('comments.index') }}" class="btn btn-primary">Back to Active Comments</a>
    </div>
</div>

@endsection